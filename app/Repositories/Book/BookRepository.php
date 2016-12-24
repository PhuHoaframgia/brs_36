<?php

namespace App\Repositories\Book;

use App\Models\Book;
use App\Repositories\BaseRepository;
use Input;

class BookRepository extends BaseRepository
{
    public function __construct(Book $book)
    {
        $this->model = $book;
    }

    public function create($request)
    {
        $fileName = config('settings.image_default');
        if (isset($request['image'])) {
            $fileName = $this->uploadImage(null);
        }

        $book = [
            'tittle' => $request['tittle'],
            'content' => $request['content'],
            'image' => $fileName,
            'num_pages' => $request['num_pages'],
            'public_date' => $request['public_date'],
            'category_id' => $request['category_id'],
            'author_id' => $request['author_id'],
        ];
        $createBook = $this->model->create($book);
        if (!$createBook) {
            throw new Exception('message.create_error');
        }

        return $createBook;
    }

    public function update($inputs, $id)
    {
        try {
            $currentBook = $this->model->find($id);
            $oldImage = $currentBook->image;
            if (isset($inputs['image'])) {
                $inputs['image'] = $this->uploadImage($oldImage);
            } else {
                $inputs['image'] = $oldImage;
            }

            $data = parent::update($inputs, $id);
        } catch (Exception $e) {
            throw new Exception(trans('book.update_user_fail'));
        }

        return $data;
    }

    public function uploadImage($oldImage)
    {
        $file = Input::file('image');
        $destinationPath = base_path() . config('settings.image_url');
        $fileName = uniqid(rand(), true) . '.' . $file->getClientOriginalExtension();
        Input::file('image')->move($destinationPath, $fileName);
        if (!empty($oldImage) && file_exists($oldImage)) {
            File::delete($oldImage);
        }

        return $fileName;
    }
}
