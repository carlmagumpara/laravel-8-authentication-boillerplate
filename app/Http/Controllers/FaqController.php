<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Faq;
use App\Http\Requests\FaqRequest;

class FaqController extends Controller
{
    public function index(Request $request)
    {
        $data = Faq::orderBy('id', 'DESC');

        if ($request->ajax() || ($request->has('search') && $request->search !== '')) {
            $searchList = Faq::where('question', 'like', '%'.$request->search.'%');

            return view('faq.list', [
                'list' => $searchList->orderBy('id', 'DESC')->paginate(10),
            ])->render();
        }

        return view('faq.index', [
            'list' => $data->paginate(10),
        ]);
    }

    public function create(FaqRequest $request)
    {
        Faq::create($request->all() + ['user_id' => $request->user()->id]);

        return response()->json([
            'redirect_url' => redirect()->back()->getTargetUrl(),
            'message' => 'FAQ Created Successfully.',
            'success' => true,
        ], 200); 
    }

    public function update($id, FaqRequest $request)
    {
        Faq::find($id)->update($request->all());

        return response()->json([
            'redirect_url' => redirect()->back()->getTargetUrl(),
            'message' => 'FAQ Updated Successfully.',
            'success' => true,
        ], 200); 
    }

    public function destroy(Request $request)
    {
        $faq = Faq::find($request->id);

        if ($faq && $faq->delete()) {
            return response()->json([
                'redirect_url' => redirect()->back()->getTargetUrl(),
                'message' => 'Successfully Deleted',
                'success' => true,
            ], 200);
        }

        return response()->json([
            'redirect_url' => redirect()->back()->getTargetUrl(),
            'message' => 'Theres an error deleting this item.',
            'success' => true,
        ], 200);
    }
}
