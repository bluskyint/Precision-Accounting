<?php

use Illuminate\Support\Facades\Route;

$goneLinks = 'how-covid-19-affected-the-irs|' .
    'resource|' .
    'explore-exciting-career-opportunities|' .
    'quickbooks|' .
    'second-financial-impact-payments-irs-report|' .
    'digital-switching-over|' .
    'you-just-have-a-few-days-to-file-2020-taxes|' .
    'resources|' .
    'senior-staff-accountant-clifton-nj|' .
    'fasbs-2021-agenda-|' .
    'how-tax-planning-matters|' .
    'payroll-management|' .
    'service/accounting-for-nonprofit-organizations|' .
    'service/business-tax-services-near-me-clifton-nj|' .
    'service/estate-planning-services-near-me-clifton-nj|' .
    'service/tax-planning-services-near-me-clifton-nj|' .
    'service/individual-tax-services-near-me-clifton-nj|' .
    'service/bookkeeping-services-near-me-clifton-nj|' .
    'service/retirement-planning-services-near-me-clifton-nj|' .
    'service/business-tax-services|' .
    'service/estate-and-trust-tax-services|' .
    'service/tax-planning|' .
    'service/bookkeeping-services|' .
    'service/individual-tax-services|' .
    'service/retirement-planning-services|' .
    'service/estate-planning-services|' .
    'service/payroll-services|' .
    'service/tax-preparation-services|' .
    'service/tax-debt-and-tax-issues|' .
    'service/tax-preparation-for-businesses|' .
    'service/tax-relief-services|' .
    'tax-center/tax-due-dates|' .
    'tax-center/tax-rates|' .
    'taxCenters|' .
    'taxCenters/irs-tax-forms-and-publications|' .
    'taxCenters/irs-tax-rates-table|' .
    'articles/how-to-file-2020-taxes-late|' .
    'articles/covid-19-affected-the-irs-employees|' .
    'authors/precision-accounting-intl-editor|' .
    'team/amr-ibrahim-cpa-cgma|' .
    'about-us.php|' .
    'blog.php|' .
    'contact-us.php|' .
    'estate-and-trust-tax-services.php|' .
    'individuals-services.php|' .
    'payroll-services.php|' .
    'record-retention-guide.php|' .
    'resources.php|' .
    'retirement-planning.php|' .
    'state-tax-forms.php|' .
    'tax-center.php|' .
    'tax-debt-and-tax-issues.php|' .
    'tax-due-dates.php|' .
    'tax-forms-and-publications.php|' .
    'tax-preparation-for-businesses.php|' .
    'tax-preparation-services.php|' .
    'tax-rates.php|' .
    'tax-relief.php';

Route::get('/{uri}', function (string $parameter, string $sub = null) {
    abort('410');
})->where('uri', $goneLinks);
