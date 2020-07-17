<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Services\ImportDataByWordService;
use App\Services\ImportDataByExcelService;
use App\Contracts\QuestionRepositoryInterface;

class QuestionController extends Controller
{
    protected $questionRepository;

    public function __construct(QuestionRepositoryInterface $questionRepository)
    {
        $this->questionRepository = $questionRepository;
    }

    public function getQuestions()
    {
        $questions = $this->questionRepository->getQuestions();
        // dd($questions->toArray());
        return view('back-end.question.index', ['questions' => $questions]);
    }

    public function create()
    {
        return view('back-end.question.create');
    }

    public function postQuestions(Request $request)
    {
        $request->validate([
            'quiz_id' => 'required|not_in:0'
        ], [
            'quiz_id.required' => 'Bạn chưa chọn danh mục',
            'quiz_id.not_in' => 'Bạn chưa chọn danh mục'
        ]);

        $quiz_id = $request->quiz_id;

        if ($request->hasFile('fileImport')) {

            $request->validate([
                'fileImport' => 'required|mimes:docx,xlsx,csv,tsv,ods,xls,slk,xml,html,gnumeric',
            ], [
                'fileImport.required' => 'Bạn chưa chọn file',
                'fileImport.mimes' => 'File không đúng định dạng',
            ]);

            $file = $request->file('fileImport');

            $extension = $file->getClientOriginalExtension();
            // dd($extension);
            DB::beginTransaction();
            try {
                if ($extension == 'docx') {
                    ImportDataByWordService::importData($file, $quiz_id);
                } else {
                    Excel::import(new ImportDataByExcelService($quiz_id), $file);
                }

                DB::commit();
                return redirect()->back()->with('messages', 'Thêm thành công');
            } catch (Exception $e) {
                DB::rollBack();
                throw new Exception($e->getMessage());
            }
        }
        return redirect()->back()->with('messages', 'truowngf hop khac');
    }
}
