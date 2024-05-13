<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Models\CampaignTag;

class ShopController extends Controller
{
    public function index()
    {

        $products = Product::where(['user_id' => domainByUserId(), 'type' => 'PRODUCT'])->whereNotNull('campaign_id')->get();
        $filterables = $products->pluck('category')->unique();

        return view('e-commerce.index', compact('products', 'filterables'));
    }

    public function category($category)
    {
        $products = Product::where(['user_id' => domainByUserId(), 'category' => $category])->whereNotNull('campaign_id')->get();

        return view('e-commerce.category', compact('category', 'products'));
    }


    public function tags(Request $request)
    {

        $search_tags = $request->name;
        $campaigns = Campaign::where('user_id', domainByUserId())->get();


        $tagNames = [];
        $campaign_id = [];
        foreach ($campaigns as $campaign) {
            $tags = $campaign->tags;

            foreach ($tags as $tag) {
                $campaign_id[] = $campaign->id;
                if (!in_array($tag->name, $tagNames)) {
                    $tagNames[] = $tag->name;
                }
            }
        }
        $products = Product::whereIn('campaign_id', $campaign_id)->whereNotNull('campaign_id')->get();
        return view('e-commerce.category', compact('products', 'search_tags'));
    }



    public function details(Product $product)
    {
        $products = Product::with('mockup.sizes', 'campaign')->where('campaign_id', $product->campaign_id)->get();
        $campaign = Campaign::findOrFail($product->campaign_id);
        
        $relateds = Product::where(['user_id' => domainByUserId(), 'type' => 'PRODUCT'])->whereNotIn('id', [$product->id])->whereNotNull('campaign_id')->limit(2)->get();
        $productId = $product->id;
        return view('e-commerce.details', compact('product', 'products', 'campaign', 'productId', 'relateds'));
    }
}
