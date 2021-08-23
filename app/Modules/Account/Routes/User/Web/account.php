<?php

Route::get('account', "AccountController@account")->name('account');

Route::get('account/referral', "AccountController@referral")->name('account.referral');
Route::get('account/referral/generate-referral-code', "AccountController@generateReferralCode")->name('account.generateReferralCode');

Route::get('account/wallet', "AccountController@wallet")->name('account.wallet');
Route::get('account/wallet/subscription-package-list', "AccountController@walletSubscriptionPackageList")->name('account.walletSubscriptionPackageList');
Route::get('account/wallet/subscribe-package/{encryptedWalletSubscriptionId}', "AccountController@subscribePackage")->name('account.subscribePackage');
