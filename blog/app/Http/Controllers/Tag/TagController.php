<?php

namespace App\Http\Controllers\Tag;

use App\Tag;
use Exception;
use Illuminate\Http\Request;
use App\Http\Requests\TagRequest;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class TagController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::orderBy('id', 'asc')->paginate(config('blog.tags.tag_limit'));
        
        return view('tag/index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tag/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TagRequest $request)
    {
        try {
            $data = [
                'tag_name' => $request->input('tag_name'),
            ];
            $result = Tag::create($data);
            if ($result) {
                return redirect()->route('tags.index')->with('message', 'Create tag successfully');
            }

            return redirect()->route('tags.index')->with('message', 'Create tag failure');
        } catch (Exception $e) {
            return redirect()->route('tags.index')->with('error', 'Create tag failure');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tag = Tag::findOrFail($id);

        return view('tag/show', compact('tag'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tag = Tag::findOrFail($id);

        return view('tag/edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TagRequest $request, $id)
    {
        try {
            $result = Tag::where('id', $id)->update(['tag_name' => $request->input('tag_name')]);
            if ($result) {
                return redirect()->route('tags.index')->with('message', 'Update tag successfully');
            }

            return redirect()->route('tags.index')->with('error', 'Update tag failure');
        } catch (Exception $e) {
            Log::error($e);

            return redirect()->back()->with('error', 'Update tag failure');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $tag = Tag::findOrFail($id);
            $tag->users()->detach();
            $tag->posts()->detach();
            $tag->delete();

            return redirect()->back()->with('message', 'Delete tag successfuly');
        } catch (Exception $e) {
            Log::error($e);

            return redirect()->back()->with('error', 'Delete tag failure');
        }
    }
}
