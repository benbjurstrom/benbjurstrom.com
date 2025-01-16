<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ResponsiveImage extends Component
{
    public string $path;
    public string $sizes;
    private array $imageSizes;

    /**
     * Create a new component instance.
     *
     * @param string $path The image path/filename
     * @param string $sizes The sizes attribute value
     */
    public function __construct(string $path, string $sizes)
    {
        $this->path = $path;
        $this->sizes = $sizes;
        $this->imageSizes = config('prezet.image.widths', []);
    }

    /**
     * Generate the srcset attribute string
     *
     * @return string
     */
    private function getSrcset(): string
    {
        $pathInfo = pathinfo($this->path);
        $dirname = $pathInfo['dirname'] === '.' ? '' : $pathInfo['dirname'] . '/';
        $basename = $pathInfo['filename'];
        $extension = $pathInfo['extension'];

        return collect($this->imageSizes)
            ->map(function($size) use ($dirname, $basename, $extension) {
                $filename = "{$dirname}{$basename}-{$size}w.{$extension}";
                return route('prezet.image', $filename) . " {$size}w";
            })
            ->implode(', ');
    }

    /**
     * Get the original image URL
     *
     * @return string
     */
    private function getOriginalSrc(): string
    {
        return route('prezet.image', $this->path);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.responsive-image', [
            'srcset' => $this->getSrcset(),
            'src' => $this->getOriginalSrc(),
        ]);
    }
}
