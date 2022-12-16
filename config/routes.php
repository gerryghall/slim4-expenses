<?php

// Define app routes

use App\Action\Claim\ClaimCreateAction;
use App\Action\Claim\ClaimDeleteAction;
use App\Action\Claim\ClaimFindAction;
use App\Action\Claim\ClaimReadAction;
use App\Action\Claim\ClaimUpdateAction;
use App\Action\Expense\ExpenseUnitFindAction;
use Slim\App;
use Slim\Routing\RouteCollectorProxy;

return function (App $app) {
    // Redirect to Swagger documentation
    $app->get('/', \App\Action\Home\HomeAction::class)->setName('home');

    // API
    $app->group(
        '/admin',
        function (RouteCollectorProxy $app) {
            $app->get('/claim', ClaimFindAction::class);
            $app->post('/claim', ClaimCreateAction::class);
            $app->get('/claim/{claim_id}', ClaimReadAction::class);
            $app->put('/claim/{claim_id}', ClaimUpdateAction::class);
            $app->delete('/claim/{claim_id}', ClaimDeleteAction::class);

            $app->get('/expense/type', \App\Action\Expense\ExpenseTypeFindAction::class);
            $app->get('/expense/unit', ExpenseUnitFindAction::class);

            $app->get('/expense', \App\Action\Expense\ExpenseFindAction::class);
            $app->post('/expense', \App\Action\Expense\ExpenseCreateAction::class);
            $app->get('/expense/{expense_id}', \App\Action\Expense\ExpenseReadAction::class);
            $app->put('/expense/{expense_id}', \App\Domain\Expense\Service\ExpenseUpatder::class);
            $app->delete('/expense/{expense_id}', \App\Domain\Expense\Service\ExpenseDeleter::class);

            $app->get('/participant', \App\Action\Participant\ParticipantFindAction::class);
            $app->post('/participant', \App\Domain\Participant\Service\ParticipantCreator::class);
            $app->get('/participant/{participant_id}', \App\Action\Participant\ParticipantReadAction::class);
            $app->put('/participant/{participant_id}', \App\Action\Participant\ParticipantUpdateAction::class);
            $app->delete('/participant/{participant_id}', \App\Action\Participant\ParticipantDeleteAction::class);
        }
    );

    $app->group(
        '/participant',
        function (RouteCollectorProxy $app) {
            $app->get('/auth',\App\Action\Participant\ParticipantAuthCompleteAction::class);
            $app->post('/auth', \App\Action\Participant\ParticipantAuthAction::class);
            $app->get('/claims', ClaimFindAction::class);
            $app->get('/expense/type', \App\Action\Expense\ExpenseTypeFindAction::class);
            $app->get('/expense/unit', ExpenseUnitFindAction::class);
            $app->get('/expenses/{claim_id}', \App\Action\Expense\ExpenseFindAction::class);
            $app->post('/expense/{claim_id}', \App\Action\Expense\ExpenseCreateAction::class);
            $app->put('/expense/{expense_id}', \App\Domain\Expense\Service\ExpenseUpatder::class);
            $app->delete('/expense/{expense_id}', \App\Domain\Expense\Service\ExpenseDeleter::class);
        }
    );
};
