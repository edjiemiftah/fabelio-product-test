<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Link;
use Carbon\Carbon;
use Goutte\Client;
use Symfony\Component\HttpClient\HttpClient;
use GuzzleHttp\Client as GuzzleClient;
use Symfony\Component\DomCrawler\Crawler;

class LinkController extends Controller
{
    public function index() {
        $links = Link::get();
        return view('index', compact('links'));
    }
    public function crawl($url) {
        $client = new GuzzleClient();
        $res = $client->request('GET', $url);
        $html = ''.$res->getBody();
        $crawler = new Crawler($html);
        $products = array();
        $product_name = $crawler->filter('h1.page-title > span')->each(function (Crawler $node, $i) {
            return $node->text();
        });
        // $price = $crawler->filter('.product-add-form > form > div.product-options-bottom > div.price-box > span.price-final_price')->each(function (Crawler $node, $i) {
        //     $harga = $node->filter('span.price-wrapper')->attr('data-price-amount');
        //     return $harga;
        // });
        $price = $crawler->filter('meta[property="product:price:amount"]')->each(function (Crawler $node, $i) {
            return $node->attr('content');
        });
        $desc = $crawler->filter('#description')->each(function (Crawler $node, $i) {
            return $node->text();
        });
        $images = $crawler->filter('.product-info__section--yotpo > .yotpo-main-widget')->each(function (Crawler $node, $i) {
            return $node->attr('data-image-url');
        });

        $products = [
            'name'  => $product_name[0],
            'price' => $price[0],
            'description' => $desc,
            'images' => $images
        ];
        return $products;
    }
    public function save(Request $request)
    {
        $this->validate($request, ['q' => 'required']);
        $c = $this->crawl($request->input('q'));
        $data = new Link();
        $data->url = $request->input('q');
        $data->name = $c['name'];
        $data->description = is_array($c['description']) ? implode(',', $c['description']) : $c['description'];
        $data->price = is_array($c['price']) ? implode(',', $c['price']) : $c['price'];
        $data->images = is_array($c['images']) ? implode(',', $c['images']) : $c['images'];
        $data->created_at = Carbon::now();
        // echo json_encode($c);
        if($data->save()) {
            return redirect()->route('link.show', $data->id);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Failed to save your link.'], 500);
        }
    }

    public function show($id) {
        $data = Link::findOrfail($id);
        return view('detail', compact('data'));
    }
}