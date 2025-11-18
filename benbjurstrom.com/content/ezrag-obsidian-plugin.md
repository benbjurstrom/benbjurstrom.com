---
title: Building a RAG Plugin for Obsidian Notes Using Google's File Store API
date: "2025-11-17T08:00:00.000Z"
excerpt: I built a RAG plugin for Obsidian using Google's new File Store API and discovered some undocumented quirks along the way.
author: benbjurstrom
image: /prezet/img/ogimages/ezrag-obsidian-plugin.webp
---

I spent the weekend building a plugin for Obsidian Notes on top of Google's new [Gemini API File Search Tool](https://blog.google/technology/developers/file-search-gemini-api/) and wanted to share what I learned along the way. You can check out the full implementation at [github.com/benbjurstrom/ezrag](https://github.com/benbjurstrom/ezrag).

As a little backgroud, I've been searching for a simple way to give Claude Desktop the ability to semantically search my Obsidian vaults. As of this writing I haven't found any solutions that just work without a lot of fiddling. So when Google announced their new API I decided to take a shot at building my own solution.

## How the File Store API Works

The basic flow is straightforward. First, you upload your documents to a Gemini File Search store along with some metadata.

```typescript
const client = new GoogleGenerativeAI(apiKey);

// Upload a document
await client.uploadFileToFileSearchStore({
  storeName: "my-notes-store",
  file: new Blob([fileContent], { type: "text/plain" }),
  displayName: "My Note.md",
  metadata: {
    path: "My Note.md",
    contentHash: "sha256hash..."
  }
});
```

Then when you want to query your notes, you configure the Gemini model to use the File Search tool:

```typescript
const model = client.getGenerativeModel({
  model: "gemini-2.5-flash-latest",
  tools: [
    {
      fileSearchTool: {
        fileSearchStores: ["my-notes-store"]
      }
    }
  ]
});

const result = await model.generateContent("What Python packages can convert PDF to markdown?");
const metadata = result.response.candidates[0].groundingMetadata;
```

This means that you don't query the vector store directly. Instead, Gemini handles the semantic search internally and returns a standard chat response along with a `groundingMetadata` object that tells you exactly which chunks from which documents supported each part of the answer.

## Understanding the Grounding Metadata

To understand how the Grounding Metadata works, let's take a look at an real message I sent via the plugin's chat interface. In the screenshot below, I asked gemini-2.5-flash to search my notes for information about a python package for converting PDFs to markdown. And as you can see the response in the UI contains citations to the specific notes that the model used.

![Chat With Your Notes example in EzRAG obsidian Plugin](ezrag-obsidian-plugin-1763425763663.webp)


To give you a sense of how this UI is built, let me show you what the raw API response looked like for the message above. I'm including the full response here because I haven't seen this readily documented anywhere else. I've shortened some parts for clarity but kept the structure intact:

```json
{
  "candidates": [
    {
      "content": {
        "parts": [
          {
            "text": "Based on your notes, the following Python packages could be used to convert a PDF into Markdown:\n\n*   **Docling**: This is an open-source package specifically designed for PDF document conversion and can output in Markdown format.\n*   **Markitdown**: This library is also capable of handling PDF files and converting them into Markdown."
          }
        ]
      },
      "groundingMetadata": {
        "groundingChunks": [
          {
            "retrievedContext": {
              "title": "Clippings/Docling Technical Report.md",
              "text": "{CHUNK_TEXT}"
            }
          },
          {
            "retrievedContext": {
              "title": "Articles/markitdown.md",
              "text": "{CHUNK_TEXT}"
            }
          }
        ],
        "groundingSupports": [
          {
            "segment": {
              "startIndex": 98,
              "endIndex": 230,
              "text": "*   **Docling**: This is an open-source package specifically designed for PDF document conversion and can output in Markdown format."
            },
            "groundingChunkIndices": [
              0
            ]
          },
          {
            "segment": {
              "startIndex": 231,
              "endIndex": 336,
              "text": "*   **Markitdown**: This library is also capable of handling PDF files and converting them into Markdown."
            },
            "groundingChunkIndices": [
              1
            ]
          }
        ]
      }
    }
  ]
}
```

As you can see the model's answer lives in `candidates.content.parts.text` like any normal chat response. But because we enabled the File Search tool, we also get `groundingMetadata`.

The **groundingChunks** array contains all the document chunks the model referenced. Each chunk includes the raw text and a `title` field that corresponds to the `displayName` provided during upload.

The **groundingSupports** array maps specific parts of the answer to their source chunks. Each segment has `startIndex` and `endIndex` pointing to character positions in the response text, plus `groundingChunkIndices` that reference the chunks array.

This structure lets you build precise citations. You know exactly which sentence came from which document.

## Summing It all up
### The Good: It Just Works

The File Store API achieves exactly what I was after. With nothing more than an API key, you get semantic search over your entire Obsidian vault that actually understands what you're asking. Based on my usage so far, the search quality is excellent. It consistently finds the relevant notes even when you phrase questions differently than how you wrote them.

The indexing is also remarkably fast. Updates are searchable within seconds, and there's no waiting around for processing queues or rate limits.

### The Bad: SDK Bug Breaks Citations

There's a [critical bug](https://github.com/googleapis/js-genai/issues/1078) in Google's TypeScript SDK that drops the `displayName` parameter. This breaks the entire citation system because you need that title field in the groundingChunks to know which document was cited.

Since my citation system depends on getting the Obsidian file path back in the `title` field, this bug essentially broke everything. I ended up monkey-patching the SDK at runtime to inject the missing parameter.
### The Ugly: No Metadata Queries

Here's the real limitation: **there's no way to query documents by metadata**. Gemini assigns random identifiers to your documents, and you can't search for them by the metadata you attached.

Want to check if a document with a specific file path already exists? You have to page through your entire collection using [fileSearchStores.documents.list](https://ai.google.dev/api/file-search/documents#method:-filesearchstores.documents.list). The kicker? You can only fetch 20 documents at a time.

I solved this by building a local index in localStorage that maps file paths to document IDs and content hashes. When files change, the plugin checks hashes locally instead of calling the API. If the local index gets out of sync (cleared storage, switched devices), a smart reconciliation system matches documents by hash to restore state without creating duplicates.
