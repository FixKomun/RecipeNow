<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Difficulty;
use App\Models\Recipe;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function upload(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|mimes:jpeg,png,jpg'
        ]);

        $imageName = time() . '.' . $request->file->extension();
        $request->file->move(public_path('uploads'), $imageName);
        return $imageName;
    }
    public function getDifficulty()
    {
        return Difficulty::all();
    }
    public function getRecipes()
    {
        return Recipe::all();
    }
    public function saveRecipe(Request $request)
    {

        $this->validate($request, [
            'title' => 'bail|required|string|max:50',
            'numOfPeople' => 'bail|required|numeric',
            'cookTime' => 'bail|required|numeric',
            'ingredients' => 'required',
            'instructions' => 'required',
            'image' => 'nullable',
            'user_id' => 'required',
            'difficultyName' => 'required'
        ]);

        $recipe = Recipe::create([
            'title' => $request->title,
            'numOfPeople' => $request->numOfPeople,
            'cookTime' => $request->cookTime,
            'ingredients' => $request->ingredients,
            'instructions' => $request->instructions,
            'image' => $request->image,
            'user_id' => $request->user_id,
            'difficultyName' => $request->difficultyName
        ]);

        return $recipe;
    }

    public function deleteImage(Request $request)
    {
        $imageName = $request->imageName;
        $this->deleteFileFromServer($imageName);
        return 'done';
    }
    public function deleteFileFromServer($imageName)
    {
        if (file_exists($imageName)) {
            @unlink($imageName);
            return;
        }
    }

    public function getRecipe(Request $request)
    {

        return Recipe::where('id', $request->id)->get();
    }

    public function editRecipe(Request $request)
    {
        $this->validate($request, [
            'title' => 'bail|required|string|max:50',
            'numOfPeople' => 'bail|required|numeric',
            'cookTime' => 'bail|required|numeric',
            'ingredients' => 'required',
            'instructions' => 'required',
            'image' => 'nullable',
            'user_id' => 'required',
            'difficultyName' => 'required'
        ]);

        Recipe::where('id', $request->id)->update([
            'title' => $request->title,
            'numOfPeople' => $request->numOfPeople,
            'cookTime' => $request->cookTime,
            'ingredients' => $request->ingredients,
            'instructions' => $request->instructions,
            'image' => $request->image,
            'user_id' => $request->user_id,
            'difficultyName' => $request->difficultyName
        ]);
        return response()->json([
            'title' => $request->title, 'numOfPeople' => $request->numOfPeople,
            'cookTime' => $request->cookTime,
            'ingredients' => $request->ingredients,
            'instructions' => $request->instructions,
            'image' => $request->image,
            'user_id' => $request->user_id,
            'difficultyName' => $request->difficultyName
        ]);
    }

    public function getUserRecipes(Request $request)
    {

        return Recipe::where('user_id', $request->id)->get();
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
