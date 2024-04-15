<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    public function index() {
        $types = Type::paginate(4);
        return view('admin.types.index', compact('types'));
    }

    public function create() {
        $type =  new Type;
        return view('admin.types.form', compact('type')); 
    }

    public function store(Request $request) {
        $data = $request->all();

        $type = new Type;

        $type->fill($data);
        
        $type->save();

        return redirect()->route('admin.types.show', $type);
    }

    public function show(Type $type) {
        return view('admin.types.show', compact('type'));
    }

    public function edit(Type $type) {
    }

    public function update(Request $request, Type $type) {

    }

    public function destroy(Type $type) {

    }

    // private function validation($data) {

    // }

}
