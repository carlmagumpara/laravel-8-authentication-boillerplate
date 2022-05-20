<?php

namespace App\Traits;

use Carbon\Carbon;
use App\Models\{ Quiz, Take };

trait TakeResults
{
    public function getResults(Take $take, Quiz $quiz)
    {
        $items = [];
        $correctItems = [];
        $incorrectItems = [];

        foreach ($quiz->quizQuestions as $question) {
            // $answers = $take->answers()->with(['quizAnswer'])->whereNotNull('quiz_answer_id')->where(['quiz_question_id' => $question->id])->get();
            $answers = $take->answers()->with(['quizAnswer'])->where(['quiz_question_id' => $question->id])->get();
            $answersId = $answers->pluck('quiz_answer_id')->toArray();

            $correctAnswers = $question->quizAnswers()->where(['correct' => true])->pluck('answer')->toArray();
            $correctAnswersIds = $question->quizAnswers()->where(['correct' => true])->pluck('id')->toArray();

            $isCorrect = false;

            if ($question->type === 'Single Select' || $question->type === 'Multiple Select') {
                if ($this->arraysAreEqual($correctAnswersIds, $answersId)) {
                    $correctItems[] = $question;
                    $isCorrect = true;
                } else {
                    $incorrectItems[] = $question;
                }
            } else {
                if (in_array(strtolower($answers[0]->input), array_map('strtolower', $correctAnswers))) {
                    $correctItems[] = $question;
                    $isCorrect = true;
                } else {
                    $incorrectItems[] = $question;
                }
            }

            $items[] = $question->toArray() + [
                'correct' => $isCorrect,
                'answers' => $answers->toArray(),
            ];
        }

        return [
            'all' => $items,
            'correct' => $correctItems,
            'incorrect' => $incorrectItems,
            'no_answer' => $take->answers()->where(['no_answer' => true])->count(),
            'score' => collect($correctItems)->sum('score'),
            'total_score' => collect($items)->sum('score'),
            'percentage' => $this->getPercentageOfTwoNumbers(collect($items)->sum('score'), collect($correctItems)->sum('score')),
        ];
    }

    public function arraysAreEqual(array $array1, array $array2)
    {
        $array1 = array_map('intval', $array1);
        $array2 = array_map('intval', $array2);

        array_multisort($array1);
        array_multisort($array2);

        return (serialize($array1) === serialize($array2));
    }

    public function getPercentageOfTwoNumbers($firstValue, $secondValue)
    {
        return round(($secondValue * 100) / $firstValue, 2);
    }
}
