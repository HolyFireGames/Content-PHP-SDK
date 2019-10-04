# HFG Content API

## Basic Usage

Include the hfg_content_api.php file into your project

```include('path/to/hfg_content_api.php');```

Initialize the class using your API Key

``` $hfgContentApi = new HFG__Content__API('YOUR_API_KEY');```

Get content in five different ways

```
\\ multiple content items
$contentItems = $hfgContentApi->getContent(); // get all content items from studio

$contentItems = $hfgContentApi->getContentByProjectId(1); // get all content items from project

$contentItems = $hfgContentApi->getContentByCategoryId(1); // get all content items from category

\\ single content items
$contentItem = $hfgContentApi->getContentById(1); // get content item by id

$contentItem = $hfgContentApi->getContentBySlug('content-slug'); // get content item by slug
```

When getting multiple items, you receive an array of content items. Here's an exmple of what a content item looks like:

```
{
  "id":"1",
  "project_id":"1",
  "type":"0",
  "author":"1",
  "status":"1",
  "lastedit":"2019-10-04 10:45:00",
  "featured_image":"https:\/\/www.example.com\/image.png",
  "title":"Content Item",
  "content":"{\"time\":1570124641350,\"blocks\":[{\"type\":\"header\",\"data\":{\"text\":\"Content Item\",\"level\":2}},{\"type\":\"image\",\"data\":{\"url\":\"https:\/\/www.example.com\/image.png\",\"caption\":\"\",\"withBorder\":false,\"withBackground\":false,\"stretched\":false}}],\"version\":\"2.15.1\"}","slug":"mikes-test",
  "meta_title":"Content Item - The Title",
  "meta_desc":"This is an example of a content item.",
  "tags":"these,are,tags",
  "category_id":"2",
  "category_name":"General",
  "content_html":"<section class=\"block-section\"><div class=\"block block-header\"><h2>Content Item<\/h2><\/div><\/section><section class=\"block-section\"><div class=\"block block-image\"><img src='https:\/\/www.example.com\/image.png' \/><\/div><\/section>"
}
```

## Things to note 

The 'content_html' property is the suggested HTML for the content, however we also include the raw data for the content in the 'content' property. This data is formatted the same as the output data for the EditorJS tool we use within the content system. You can find more info about the EditorJS data here: https://editorjs.io/saving-data

Including the raw 'content' data allows you to build out the HTML any way you wish.

No CSS is included with thesuggested HTML, therefore you will need to add the styling to the HTML yourself.
