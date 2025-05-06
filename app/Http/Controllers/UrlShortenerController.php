<?php

namespace App\Http\Controllers;

use App\Models\UrlShortener;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class UrlShortenerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {

        // Validate
        $validator = Validator::make($request->all(), [
            'url' => ['required', 'url', 'unique:url_shorteners,original_url']
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Create
        $shortenedUrl = UrlShortener::create([
            'original_url' => $request->url,
            'short_code' => UrlShortener::generateUniqueCode()
        ]);

        // Return
        return redirect()->route('show_url', ['urlShortener' => $shortenedUrl->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(UrlShortener $urlShortener)
    {
        // last generated links
        $lastGenerated = UrlShortener::all()->sortByDesc('created_at');

        // links with the most views
        $mostVisited = UrlShortener::all()->sortByDesc('url_visited');

        // QR Code
        $qrCode = QrCode::size(100)->generate(url('/') . "/$urlShortener->short_code");


        return view('url_shortened', ['shortened_url' => $urlShortener, 'qrCode' => $qrCode, 'last_generated_links' => $lastGenerated, 'most_visited_links' => $mostVisited]);
    }

    public function redirectToOriginalURL(Request $request): RedirectResponse
    {
        $shortened_url = UrlShortener::query()->where('short_code', $request->input('id'))->firstOrFail();
        $shortened_url->url_visited++;
        $shortened_url->save();
        return redirect($shortened_url->original_url);
    }
}
