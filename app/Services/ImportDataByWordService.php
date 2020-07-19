<?php

namespace App\Services;

use ZipArchive;
use DOMDocument;
use App\Models\Answer;
use App\Models\Question;
use App\Models\ExamDetail;

class ImportDataByWordService
{

    public static function importData($file, $quiz_id, $exam_id = 0)
    {
        $filePath = $file->getRealPath();
        $striped_content = '';
        $zip = new ZipArchive;
        $dataFile = 'word/document.xml';
        // Open received archive file
        if (true === $zip->open($filePath)) {

            if (($index = $zip->locateName($dataFile)) !== false) {
                $data = $zip->getFromIndex($index);
                $zip->close();

                $dom = new DOMDocument;
                $dom->loadXML($data, LIBXML_NOENT
                    | LIBXML_XINCLUDE
                    | LIBXML_NOERROR
                    | LIBXML_NOWARNING);

                $xmldata = $dom->saveXML();

                $striped_content = strip_tags($xmldata);

                $striped_content = trim($striped_content);

                $arr_data = explode("#q#", $striped_content);

                $arr_exam_detail = [];

                foreach ($arr_data as $data) {

                    if (!empty($data)) {
                        $arr_exam_detail = ImportDataByWordService::insertQuestion($data, $quiz_id, $exam_id, $arr_exam_detail);
                    }
                }
                if ($exam_id != 0) {
                    ExamDetail::insert($arr_exam_detail);
                }
            }
        }
    }


    private static function insertQuestion($data, $quiz_id, $exam_id = 0, $arr_exam_detail = [])
    {
        $arr_question = explode("#a#", $data);

        $question_title = $arr_question[0];

        $question = Question::firstOrCreate(
            [
                'quiz_id' => $quiz_id, 'title' => $question_title
            ],
            [
                'question_type' => 'text', 'answer_type' => 'single_select'
            ]
        );

        $question_id = $question->id;

        if ($exam_id != 0) {
            array_push($arr_exam_detail, [
                'exam_id' => $exam_id,
                'question_id' => $question_id
            ]);
        }

        $str_answers = strstr($data, "#a#");
        $arr_answers = explode("#a#", $str_answers);
        $arr_answers = array_filter($arr_answers, 'strlen');

        if (count($arr_answers) == 1) {
            Question::where('id', $question_id)->update(['answer_type' => 'fill_text']);
        }

        ImportDataByWordService::insertMultipleAnswer($arr_answers, $question_id);

        return $arr_exam_detail;
    }

    private static function insertMultipleAnswer($arr_answers, $question_id)
    {
        $total_true_answer = 0;

        foreach ($arr_answers as $val) {
            if (!empty($val)) {

                $answer = new Answer();

                if (substr($val, 0, 1) === '*') {
                    $val = trim($val);
                    $answer_title = substr($val, 1);
                    $answer->title = trim($answer_title);
                    $answer->question_id = $question_id;
                    $answer->correct = true;
                    $answer->save();

                    $total_true_answer += 1;

                    continue;
                }

                $answer->title = $val;
                $answer->question_id = $question_id;
                $answer->save();
            }
        }

        if ($total_true_answer > 1) {
            Question::where('id', $question_id)->update(['answer_type' => 'multi_select']);
        }
    }
}
