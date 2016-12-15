<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Author\AuthorRepository;
use App\Http\Requests\CreateAuthorRequest;
use App\Http\Requests\UpdateAuthorRequest;

class AuthorController extends Controller
{
    protected $authorRepository;

    public function __construct(AuthorRepository $authorRepository)
    {
        $this->authorRepository = $authorRepository;
    }

    public function index()
    {
        $authors = $this->authorRepository->paginate(5);

        return view('admin.author.list', compact('authors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.author.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateAuthorRequest $request)
    {
        $input = $request->only('name');

        if ($this->authorRepository->create($input)) {
            return redirect()->action('Admin\AuthorController@index')
                ->with('success', trans('author.create_author_successfully'));
        }

        return redirect()->action('Admin\AuthorController@index')
            ->with('fails', trans('author.create_author_fail'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $author = $this->authorRepository->find($id);

        if (!$author) {
            return redirect()->action('Admin\AuthorController@index')
                ->with('fails', trans('author.author_not_found'));
        }

        return view('admin.author.show', compact('author'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $author = $this->authorRepository->find($id);

        if (!$author) {
            return redirect()->action('Admin\AuthorController@index')
                ->with('fails', trans('author.author_not_found'));
        }

        return view('admin.author.edit', compact('author'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAuthorRequest $request, $id)
    {
        $input = $request->only('name');
        if ($this->authorRepository->update($input, $id)) {
            return redirect()->action('Admin\AuthorController@index')
                ->with('success', trans('author.update_author_successfully'));
        }

        return redirect()->action('Admin\AuthorController@index')->with('fails', trans('author.update_author_fail'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $author = $this->authorRepository->find($id);

        if (!$author) {
            return redirect()->action('Admin\AuthorController@index')
                ->with('fails', trans('author.author_not_found'));
        }

        if ($this->authorRepository->delete($id)) {
            return redirect()->action('Admin\AuthorController@index')
                ->with('success', trans('author.delete_author_successfully'));
        }

        return redirect()->action('Admin\AuthorController@index')->with('fails', trans('author.delete_author_fail'));
    }
}
