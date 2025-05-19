// Criteria Routes
Route::apiResource('criteria', CriteriaController::class);
Route::get('criteria/{criteriaId}/rating-scales', [CriteriaRatingScaleController::class, 'getByCriteria']);
Route::get('criteria/{criteriaId}/comparisons', [CriteriaComparisonController::class, 'getByCriteria']);

// Criteria Rating Scale Routes
Route::apiResource('criteria-rating-scales', CriteriaRatingScaleController::class);

// Criteria Comparison Routes
Route::apiResource('criteria-comparisons', CriteriaComparisonController::class);