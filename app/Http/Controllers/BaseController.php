<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

abstract class BaseController extends Controller
{
    protected $class;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function index(Request $request)
    {
        $resource = $this->class::all();
        if ($resource->isEmpty()) {
            return response()->json(
                ["error" => "There is no $this->className registered"],
                404
            );
        }
        return $this->class::paginate($request->per_page);
    }

    public function store(Request $request)
    {
        return response()
            ->json(
                $this->class::create($request->all()),
                201
            );
    }

    public function show(int $id)
    {
        $resource = $this->class::find($id);
        if (is_null($resource)) {
            return response()->json(
                [
                    "error" => ucfirst($this->className) . " not found"
                ],
                404
            );
        }
        return response()->json($resource);
    }

    public function update(int $id, Request $request)
    {
        $resource = $this->class::find($id);

        if (is_null($resource)) {
            return response()->json(
                [
                    "error" => ucfirst($this->className) . " not found"
                ], 404);
        }
        $resource->fill($request->all());
        $resource->save();
        return response()->json($resource);
    }

    public function destroy(int $id)
    {
        $qtyResourcesRemoved = $this->class::destroy($id);
        if ($qtyResourcesRemoved === 0) {
            return response()->json(
                [
                    "error" => ucfirst($this->className) . " not found"
                ], 404);
        }
        return response()->json([
            "success" => ucfirst($this->className) . " removed successfully"
        ], 200);
    }
}
