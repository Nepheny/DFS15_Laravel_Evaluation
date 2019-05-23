<?php

namespace App\Http\Controllers;

use App\Topic;
use App\Comment;
use Illuminate\Http\Request;
use Validator;
use Auth;

class TopicController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only('create', 'store', 'edit', 'update', 'destroy');
    }

    /**
     * Display a listing of the resource.
     * CONSIGNE: liste tous les topic par ordre décroissant et affiche la vue index
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $topics = Topic::orderBy('id','desc')->get();

        return view('index', ['topics' => $topics]);
    }

    /**
     * Show the form for creating a new resource.
     * CONSIGNE: affiche la vue create
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     * CONSIGNE: crée un Topic si le formulaire est correct et redirige vers la vue index
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:75',
            'message' => 'required|string'
        ]);

        if($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $topic = new Topic();
        $topic->name = $request->name;
        $topic->message = $request->message;
        $topic->user_id = Auth::id();
        $topic->save();
;
        return redirect()->route('home')->with(["status" =>"Topic ajouté"]);
    }

    /**
     * Display the specified resource.
     * CONSIGNE: ???
     *
     * @param  \App\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function show(Topic $topic)
    {
        return view('show', ['topic' => $topic]);
    }

    /**
     * Show the form for editing the specified resource.
     * CONSIGNE: affiche la vue edit
     *
     * @param  \App\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function edit(Topic $topic)
    {
        return view('edit', ['topic' => $topic]);
    }

    /**
     * Update the specified resource in storage.
     * CONSIGNE: met à jour un Topic si le formulaire est correct et redirige vers la vue index
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Topic $topic)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:75',
            'message' => 'required|string'
        ]);

        if($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $topic->name = $request->name;
        $topic->message = $request->message;
        $topic->save();
;
        return redirect()->route('home')->with(["status" =>"Topic modifié"]);
    }

    /**
     * Remove the specified resource from storage.
     * CONSIGNE: supprime un Topic
     *
     * @param  \App\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function destroy(Topic $topic)
    {
        $topic->delete();

        return redirect()->route('home')->with(["status" =>"Topic supprimé"]);
    }

    /**
     * Store a new comment for a specific topic in storage.
     * CONSIGNE: crée un Commentaire si le formulaire est correct et redirige vers la vue index
     *
     * @param  \App\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function comment(Request $request)
    {
        $validator = Validator::make($request->all(), ['message' => 'required|string']);

        if($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $comment = new Comment();
        $comment->message = $request->message;
        $comment->topic_id = $request->id;
        $comment->save();

        return redirect()->route('home')->with(["status" =>"Commentaire ajouté"]);
    }

    /**
     * Search for a specific topic.
     * CONSIGNE: récupère les Topic en fonction du paramètre de recherche et affiche la vue index
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $topics = Topic::where('name', 'Like', "%$request->search%")->orderBy('name','desc')->get(); 

        return view('index', ['topics' => $topics]);
    }
}
