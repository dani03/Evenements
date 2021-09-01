<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class EventController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['only' => ['create', 'store']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::where('start_at', '>=', now())
        ->with(['user', 'tags'])
        ->orderBy('start_at', 'asc')
        ->get();

        return view('events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('events.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $authed_user = auth()->user();
       $event = $authed_user->events()->create([
            'title' => $request->title,
            'description' => $request->content,
            'slug' => Str::slug($request->title),
            'premium' => $request->filled('premium'),
            'start_at' => $request->start_at,
            'end_at' => $request->end_at,
        ]);
       
        $tags = explode(',', $request->tags);

        foreach ($tags as $inputTag) {
            $inputTag = trim($inputTag);

           $tag =  Tag::firstOrCreate([
                'slug' => Str::slug($inputTag)
            ], [
                'name' => $inputTag
            ]);

            $event->tags()->attach($tag->id);
        }

        return redirect()->route('events.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        //
    }
}
