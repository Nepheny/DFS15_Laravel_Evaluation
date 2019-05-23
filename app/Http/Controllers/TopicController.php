<?php

namespace App\Http\Controllers;

use App\Topic;
use App\Comment;
use Illuminate\Http\Request;

class TopicController extends Controller
{
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
        $topic->save();
;
        return redirect()->route('topics.index')->with(["status" =>"Topic ajouté"]);
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
        //
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
        return redirect()->route('topics.index')->with(["status" =>"Topic modifié"]);
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

        return redirect()->route('topics.index')->with(["status" =>"Topic supprimé"]);
    }

    /**
     * Store a new comment for a specific topic in storage.
     * CONSIGNE: crée un Commentaire si le formulaire est correct et redirige vers la vue index
     *
     * @param  \App\Topic  $topic
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function comment(Request $request, int $id)
    {
        $validator = Validator::make($request->all(), ['message' => 'required|string']);

        if($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $comment = new Comment();
        $comment->message = $request->message;
        $comment->topic_id = $id;
        $comment->save();
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
        $topics = Voyage::where('name', 'Like', "%$request->name%")->orderBy('name','desc')->get(); 

        return view('index', ['topics' => $topics]);
    }
}
