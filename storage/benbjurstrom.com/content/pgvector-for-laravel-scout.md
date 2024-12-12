---
title: Simple Vector Similarity Search For Laravel
date: "2024-11-17T08:00:00.000Z"
excerpt: What if you wanted to search your data by a concept. Not a keyword. But rather something more abstract, like a category? How would you accomplish that?
author: [Ben Bjurstrom, "https://benbjurstrom.com.s3-us-west-2.amazonaws.com/img/headshot.jpg"]
image: /prezet/img/ogimages/pgvector-for-laravel-scout.webp
---

```html +parse
<x-alert title="TL;DR">
    I wrote a Pgvector driver for Laravel Scout that makes it simple to search and maintain vector embeddings. Scout works well with pgvector since its model observers will automatically keep the vector embeddings up to date. The repository for the package can be found here: <a class="text-primary-600 font-medium external-link" href="https://github.com/benbjurstrom/pgvector-scout">github.com/benbjurstrom/pgvector-scout</a>
</x-alert>
```

What if you wanted to search your data by a concept. Not a keyword. But rather something more abstract, like a category? How would you accomplish that? Allow me to illustrate what I'm talking about. Throughout this article, we're going to be working with the [Amazon Fine Food Reviews](https://www.kaggle.com/datasets/snap/amazon-fine-food-reviews) dataset. Here I've pulled the first 500 reviews into a table as part of a demo application.

![](pgvector-for-laravel-scout-20241117075705970.webp)

I think we all know how to query that dataset for a keyword like "pancakes." We could even add some fuzzy search so the singular form "pancake" is also returned. But what if we wanted to search for all the reviews related to breakfast food? This would include pancakes but also waffles, eggs, oatmeal, etc. You and I understand that all of those things are breakfast foods, but how do we search for them?

The solution lies in vector embeddings. In simple terms, vector embeddings are numerical representations of data that capture semantic meaning. Using a large language model to generate vector embeddings, we can map pieces of text into a high-dimensional space where similar concepts tend to be clustered together. 

![](pgvector-for-laravel-scout-20241117121438216.webp)

In our breakfast example, reviews mentioning different types of breakfast foods would end up in roughly the same region of this space. We could then query the distance between the vector for a generic search term like "Breakfast" and our reviews. The reviews with the shortest distance from our search term likely relate to breakfast food (assuming they exist in the dataset).

Historically, to store embeddings and calculate distances between vectors, you needed a dedicated vector database. However, with the release of the [Pgvector](https://github.com/pgvector/pgvector) extension for PostgreSQL, it's possible to store embeddings and perform similarity searches in the same relational database you're already using to store your data. 

## Pgvector and Laravel Scout: A Perfect Match

But how do we manage all of this simply in a Laravel application? In our reviews example, we have to first convert the text of the reviews into vector embeddings using some API such the one provided by OpenAI. Then we have to do the same thing with our "Breakfast" search term. Plus we need to keep all of our embeddings in sync as reviews are edited, updated, or deleted.

Thankfully [Laravel Scout](https://laravel.com/docs/11.x/scout) provides the perfect tool for managing this complexity. Laravel Scout is a first party driver-based library that provides a straightforward way to add search capabilities to your eloquent models. It includes model observers, which automatically synchronize data with the search index whenever a model is created, updated, or deleted.

I created a driver for Laravel Scout that taps into these model observers to automatically keep the vector embeddings up to date as the data changes. This means that every time data is created, updated, or deleted, the associated vector embeddings will also be kept in sync.

You can find the repository for the driver here: [github.com/benbjurstrom/pgvector-scout](https://github.com/benbjurstrom/pgvector-scout).

## Demo Application: Searching Amazon Reviews

To demonstrate how this works in practice, I put together a demo application using the aforementioned Amazon Fine Foods Reviews dataset. The repository for the demo can be found here: [github.com/benbjurstrom/pgvector-scout-demo](https://github.com/benbjurstrom/pgvector-scout-demo).

### Database and Model Setup
This application includes a migration for a reviews table, along with database seeders containing the first 500 Amazon Fine Food reviews and their corresponding embeddings derived from the OpenAI `text-embedding-3-small` model.

It also includes an eloquent model for the reviews table with the two required traits applied: `HasEmbeddings` and `Searchable`.
```php
// App\Models\Review

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use BenBjurstrom\PgvectorScout\Models\Concerns\HasEmbeddings;

class Review extends Model
{
    use HasEmbeddings, Searchable;
```

### Searching The Index
And that's all the setup needed. From there the index controller accepts a query which is then passed to Laravel Scout's model search method. Which is automatically converted to a vector using OpenAI and the similarity search is performed against the database. The 50 reviews that are nearest to the search term in vector space are then passed to the blade view.

```php
// App\Http\Controllers\ReviewController

public function index(Request $request)
{
	$query = $request->query('query');

	$reviews = Review::search($query)
		->paginate(50)
		->withQueryString();

	return view('reviews.index', [
		'reviews' => $reviews,
		'query' => $query
	]);
}
```

And the results for our Breakfast query can be seen in the image below. Also, the right hand column now shows the distance between our vectorized search term and the review's embedding.

![](pgvector-for-laravel-scout-20241117075544162.webp)

### Finding Related Reviews
The demo application also show's how to surface related reviews when navigating to the review details page. This is accomplished in the ReviewController's show method by passing the vector of the current review to the model's search method.

From there the nearest six results are selected and passed to the blade view.

```php
    // App\Http\Controllers\ReviewController
    
    public function show(string $id)
    {
        $review = Review::findOrFail($id);

        $relatedReviews = Review::search($review->embedding->vector)
            ->take(6)
            ->get();

        return view('reviews.show', compact('review', 'relatedReviews'));
    }
```

The resulting six reviews related to a review about dog food look like this:

![](pgvector-for-laravel-scout-20241117122737083.webp)
