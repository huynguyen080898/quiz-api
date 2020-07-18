<?php

namespace App\Http\Controllers;

use Exception;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use App\Services\ImportDataByWordService;
use App\Contracts\ExamRepositoryInterface;
use App\Contracts\QuizRepositoryInterface;
use App\Services\ImportDataByExcelService;
use App\Contracts\ResultRepositoryInterface;
use App\Services\ImportDataByDatabaseService;

class ExamController extends Controller
{
    protected $quizRepository;
    protected $examRepository;
    protected $resultRepository;

    public function __construct(
        QuizRepositoryInterface $quizRepository,
        ExamRepositoryInterface $examRepository,
        ResultRepositoryInterface $resultRepository
    ) {
        $this->quizRepository = $quizRepository;
        $this->examRepository = $examRepository;
        $this->resultRepository = $resultRepository;
    }

    public function getExams()
    {
        $exams = $this->examRepository->getExams();
        return view('back-end.exam.index', ['exams' => $exams]);
    }

    public function create()
    {
        return view('back-end.exam.create');
    }

    public function getExam($examID)
    {
        $exam = $this->examRepository->getExam($examID);

        return view('back-end.exam.edit', ['exam' => $exam]);
    }

    public function putExam(Request $request, $exam)
    {
        $this->examRepository->putExam($request, $exam);

        return redirect()->back()->with('messages', 'Lưu thành công');;
    }

    public function postExam(Request $request)
    {
        // $request->validate([
        //     'quiz_id' => 'bail|required',
        //     'title' => 'required|max:255',
        //     // 'time' => 'required|numeric',
        //     'key' => 'max:5'
        // ], [
        //     'quiz_id.required' => 'Bạn chưa chọn danh mục',
        //     'title.required' => 'Bạn chưa nhập tên bài thi',
        //     // 'time.required' => 'Bạn chưa nhập thời gian thi',
        //     'time.numeric' => 'Thời gian thi phải là số',
        //     'key.max' => 'Khoa bai thi toi da 5 ky tu'
        // ]);
        // dd($request->all());

        DB::beginTransaction();
        try {

            $exam = $this->examRepository->postExam($request);
            $exam_id = $exam->id;
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

                if ($extension == 'docx') {
                    ImportDataByWordService::importData($file, $quiz_id, $exam_id);
                } else {
                    Excel::import(new ImportDataByExcelService($quiz_id, $exam_id), $file);
                }

                DB::commit();
                return redirect()->back()->with('messages', 'Thêm thành công');
            }

            ImportDataByDatabaseService::importData($exam_id, $request);
            DB::commit();
            return redirect()->back()->with('messages', 'Thêm thành công');
        } catch (Exception $e) {
            Log::debug($e);
            DB::rollBack();
            throw new Exception($e->getMessage());
        }
    }

    public function getStatistics($exam_id)
    {
        $results = $this->resultRepository->getStatistics($exam_id);
        // dd($results->toArray());
        $total_user_pass = 0;
        foreach ($results as $result) {
            if ($result->total_true_answer >= $result->total_question / 2) {
                $total_user_pass += 1;
            }
        }
        // dd($results->toArray());
        return view('back-end.statistical.index', compact(['results', 'total_user_pass', 'exam_id']));
    }
}
