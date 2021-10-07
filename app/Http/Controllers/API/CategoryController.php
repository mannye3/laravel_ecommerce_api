<?php

namespace App\Http\Controllers\API;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{


    public function index()
    {
        $category = Category::all();

        return response()->json([
            'status' => 200,
            'category' => $category,
        ]);


    }


    public function allcategory()
    {
        $category = Category::where('status', '0')->get();

        return response()->json([
            'status' => 200,
            'category' => $category,
        ]);


    }



    public function edit($id)
    {
        $category = Category::find($id);
        if($category)
        {
            return response()->json([
                'status' => 200,
                'category' => $category,
            ]);
        }
        else
        {
            return response()->json([
                'status' => 404,
                'message' => 'Category Not Found',
            ]);
        }
    }


    // public function update(Request $request, $id)
    // {
    //     $validator = Validator::make($request->all(),[
    //         'meta_title' => 'required|max:191',
    //         'slug' => 'required',
    //         'name' => 'required',

    //     ]);

    //     if($validator->fails())
    //     {
    //         return response()->json([
    //             'validator_err' => $validator->messages(),

    //         ]);
    //     }


    //     else
    //     {
    //         $category =  Category::find($id);

    //         if($category)
    //         {



    //         $student->name = $request->input('name');
    //         $student->course = $request->input('course');
    //         $student->email = $request->input('email');
    //         $student->phone = $request->input('phone');
    //         $student->update();

    //         return response()->json([
    //             'status' => 200,
    //             'message' => 'Student update Successfully',
    //         ]);
    //      }
    //      else
    //      {
    //          return response()->json([

    //              'status' => 404,
    //              'message' =>'No student ID Found',

    //          ]);
    //      }
    //     }

    // }






    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'meta_title' => 'required|max:191',
            'slug' => 'required',
            'name' => 'required',
        ]);

        if($validator->fails())
        {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages(),
            ]);
        }

        else
        {

        $category = Category::find($id);

        if($category)

        {



        $category->meta_title = $request->input('meta_title');
        $category->meta_keywords = $request->input('meta_keywords');
        $category->meta_descrip = $request->input('meta_descrip');
        $category->slug = $request->input('slug');
        $category->name = $request->input('name');
        $category->description = $request->input('description');
        $category->status = $request->input('status') == true ? '1' : '0';

        $category->save();
        return response()->json([
            'status' => 200,
            'message' => 'Category Updated Successfully',
        ]);

    }

    else
    {
        return response()->json([
            'status' => 404,
            'message' => 'No category Id found',
        ]);
    }

    }

    }





    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'meta_title' => 'required|max:191',
            'slug' => 'required',
            'name' => 'required',
        ]);

        if($validator->fails())
        {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        }

        else
        {

        $category = new Category;
        $category->meta_title = $request->input('meta_title');
        $category->meta_keywords = $request->input('meta_keywords');
        $category->meta_descrip = $request->input('meta_descrip');
        $category->slug = $request->input('slug');
        $category->name = $request->input('name');
        $category->description = $request->input('description');
        $category->status = $request->input('status') == true ? '1' : '0';

        $category->save();
        return response()->json([
            'status' => 200,
            'message' => 'Category Added Successfully',
        ]);

    }

    }



    public function destroy($id)
    {
        $category = Category::find($id);


        if($category)
        {
            $category->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Category deleted Successfully',
            ]);
        }

        else
        {
            return response()->json([
                'status' => 404,
                'message' => 'No category Id found',
            ]);
        }



        return response()->json([
            'status' => 200,
            'message' => 'Category deleted Successfully',
        ]);
    }
}
