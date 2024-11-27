<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\QuestionsController;

use App\Http\Controllers\gest_pages\LandingPageController;
use App\Http\Controllers\gest_pages\BLogPageController;

use App\Http\Controllers\auth_pages\DashboardController;
use App\Http\Controllers\auth_pages\AI_tool_CategorieController;
use App\Http\Controllers\auth_pages\AI_tool_edit_Controller;
use App\Http\Controllers\auth_pages\AI_toolController;
use App\Http\Controllers\auth_pages\AI_tool_template_Controller;
use App\Http\Controllers\auth_pages\chat_conversationController;
use App\Http\Controllers\auth_pages\AI_tool_dataController;
use App\Http\Controllers\auth_pages\SubscriptionController;


use App\Http\Controllers\admin_pages\Dashboard_adminController;
use App\Http\Controllers\admin_pages\user_manegement_adminController;
use App\Http\Controllers\admin_pages\general_setting_adminController;
use App\Http\Controllers\admin_pages\Finance_adminController;
use App\Http\Controllers\admin_pages\Blogs_adminController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


// ***************************gest pages

Route::get('/', [LandingPageController::class, 'index'])
    ->name('gest.page');

Route::get('/blog/{id}', [BLogPageController::class, 'index'])
    ->name('gest.blog');
// ***************************auth pages
Route::middleware(['verified'])->group(function () {
    ///////////////quastions
    Route::get('/questions', [QuestionsController::class, 'index'])
    ->name('answer.questions')
    ->middleware('auth');

    Route::get('/questions/save', [QuestionsController::class, 'store'])
    ->name('answer.store')
    ->middleware('auth');

    Route::post('/questions_skip', [QuestionsController::class, 'skip'])
    ->name('answer.skip')
    ->middleware('auth');

    ///////////////dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard')
    ->middleware('auth');

    ///////////////ai-categories
    Route::get('/AI_tool_Categorie', [AI_tool_CategorieController::class, 'store'])
    ->name('AI_tool_Categorie')
    ->middleware('auth');

    Route::get('/AI_tool_Categorie/{categorie}/{type}', [AI_tool_CategorieController::class, 'show'])
    ->name('AI_tool_Categorie.show')
    ->middleware('auth');

    Route::get('/ai_categories_list', [AI_tool_CategorieController::class, 'ai_categories_list'])
    ->name('ai_categories_list')
    ->middleware('auth');

    Route::post('/ai_categories_list/{id}/add_favorit', [AI_tool_CategorieController::class, 'add_favorit'])
    ->name('add_favorit_cat')
    ->middleware('auth');

    Route::post('/ai_categories_list/{id}/add_sub_favorit', [AI_tool_CategorieController::class, 'add_sub_favorit'])
    ->name('add_sub_favorit_cat')
    ->middleware('auth');

    Route::get('/ai_categories_list/{id}/remove_from_favorit_cat', [AI_tool_CategorieController::class, 'remove_from_favorit'])
    ->name('remove_from_favorit_cat')
    ->middleware('auth');

    Route::get('/ai_categories_list/{id}/remove_from_sub_favorit_cat', [AI_tool_CategorieController::class, 'remove_from_sub_favorit'])
    ->name('remove_from_sub_favorit_cat')
    ->middleware('auth');

    Route::get('/ai_categories_list/{id}/remove_from_custom_favorit_cat', [AI_tool_CategorieController::class, 'remove_from_custom_favorit'])
    ->name('remove_from_custom_favorit_cat')
    ->middleware('auth');

    ///////////////edit tools
    Route::get('/ai_tools_edit', [AI_tool_edit_Controller::class, 'index'])
    ->name('edit_tools')
    ->middleware('auth');

    Route::get('/ai_tools_edit/{id}/edit', [AI_tool_edit_Controller::class, 'edit'])
    ->name('ai_tools_edit.edit')
    ->middleware('auth');

    Route::get('/ai_tools_edit/{id}/update', [AI_tool_edit_Controller::class, 'update'])
    ->name('ai_tools_edit.update')
    ->middleware('auth');

    Route::post('/ai_tools_edit/{id}/{id_cat}/add_favorit', [AI_tool_edit_Controller::class, 'add_favorit'])
    ->name('add_special_favorit_tool')
    ->middleware('auth');

    ///////////////ai-tools
    Route::get('/ai_tools_list', [AI_toolController::class, 'index'])
    ->name('ai_tools_list')
    ->middleware('auth');

    Route::post('/ai_tools_list/{id}/add_favorit', [AI_toolController::class, 'add_favorit'])
    ->name('add_favorit_tool')
    ->middleware('auth');

    Route::post('/ai_tools_list/{id}/{id_cat}/add_favorit', [AI_toolController::class, 'add_favorit_tool_custom'])
    ->name('add_favorit_tool_custom')
    ->middleware('auth');

    Route::post('/ai_tools_list/{id}/{id_cat}/add_sub_favorit', [AI_toolController::class, 'add_sub_favorit_tool_custom'])
    ->name('add_sub_favorit_tool_custom')
    ->middleware('auth');

    Route::get('/ai_tools_list/{id}/remove_from_favorit', [AI_toolController::class, 'remove_from_favorit'])
    ->name('remove_from_favorit')
    ->middleware('auth');

    Route::get('/ai_tools_list/{id}/remove_from_sub_favorit', [AI_toolController::class, 'remove_from_sub_favorit'])
    ->name('remove_from_sub_favorit')
    ->middleware('auth');

    // tools template

    Route::get('/ai_tools_template/{id_tool}', [AI_tool_template_Controller::class, 'index'])
    ->name('ai_tools_template')
    ->middleware('auth');

    // Route::get('/ai_tools_template/{id_tool}', [AI_tool_template_Controller::class, 'index'])
    // ->name('ai_tools_template')
    // ->middleware(['auth', 'App\Http\Middleware\CorsMiddleware']);

    // Route::group(['middleware' => 'cors'], function () {
    //     Route::post('/icon/image_generated/6602ecf2011775.69221202.webp', [AI_tool_template_Controller::class, 'getImage']);
    // });

    Route::get('/ai_tools_template/{id_tool}/add_feild', [AI_tool_template_Controller::class, 'add_feild'])
    ->name('ai_tools_template.add_feild')
    ->middleware('auth');

    Route::get('/ai_tools_template/{id_tool}/destroy', [AI_tool_template_Controller::class, 'destroy'])
    ->name('ai_tools_template.destroy')
    ->middleware('auth');

    Route::get('/ai_tools_template/{id_feild}/edit_feild', [AI_tool_template_Controller::class, 'edit_feild'])
    ->name('ai_tools_template.edit_feild')
    ->middleware('auth');

    Route::post('/ai_tools_template/generate', [AI_tool_template_Controller::class, 'generate'])
    ->name('ai_tools_template.generate')
    ->middleware('auth');

    Route::post('/ai_tools_template/generateImage', [AI_tool_template_Controller::class, 'generateImage'])
    ->name('ai_tools_template.generateImage')
    ->middleware('auth');

    Route::post('/ai_tools_template/generateSpeechToText', [AI_tool_template_Controller::class, 'generateSpeechToText'])
    ->name('ai_tools_template.generateSpeechToText')
    ->middleware('auth');

    Route::post('/ai_tools_template/getTranscriptionResult', [AI_tool_template_Controller::class, 'getTranscriptionResult'])
    ->name('ai_tools_template.getTranscriptionResult')
    ->middleware('auth');

    Route::post('/ai_tools_template/generateTextToSpeech', [AI_tool_template_Controller::class, 'generateTextToSpeech'])
    ->name('ai_tools_template.generateTextToSpeech')
    ->middleware('auth');

    Route::post('/ai_tools_template/{id_tool}/{tokens}/countToken', [AI_tool_template_Controller::class, 'countToken'])
    ->name('ai_tools_template.countToken')
    ->middleware('auth');

    // tools conversation 

    Route::get('/tools_Conversation/{id_tool}', [chat_conversationController::class, 'index'])
    ->name('tools_Conversation')
    ->middleware('auth');

    Route::get('/tools_Conversation/{id_tool}/{id_conversation}/nextPage', [chat_conversationController::class, 'nextPage'])
    ->name('tools_Conversation.nextPage')
    ->middleware('auth');

    Route::post('/tools_Conversation/{id_tool}/{id_conversation}/generate', [chat_conversationController::class, 'generate'])
    ->name('tools_Conversation.generate')
    ->middleware('auth');

    
    Route::post('/tools_Conversation/{id_tool}/store', [chat_conversationController::class, 'store'])
    ->name('tools_Conversation.store')
    ->middleware('auth');

    Route::post('/tools_Conversation/{id_tool}/edit', [chat_conversationController::class, 'edit'])
    ->name('tools_Conversation.edit')
    ->middleware('auth');

    Route::get('/tools_Conversation/{id_conversation}/{id_tool}/destroy', [chat_conversationController::class, 'destroy'])
    ->name('tools_Conversation.destroy')
    ->middleware('auth');

    // tools data

    Route::get('/document_data', [AI_tool_dataController::class, 'document_data'])
    ->name('document_data')
    ->middleware('auth');

    Route::get('/document_data/{id_tool}/document_edit', [AI_tool_dataController::class, 'document_edit'])
    ->name('document_data.document_edit')
    ->middleware('auth');

    Route::get('/document_data/{id_tool}/document_delete', [AI_tool_dataController::class, 'document_delete'])
    ->name('document_data.document_delete')
    ->middleware('auth');
    
    Route::post('/document_data/{id_doc}/textsave', [AI_tool_dataController::class, 'textsave'])
    ->name('document_data.textsave')
    ->middleware('auth');

    Route::post('/document_data/{id}/textedit', [AI_tool_dataController::class, 'textedit'])
    ->name('document_data.textedit')
    ->middleware('auth');

    Route::get('/code_data', [AI_tool_dataController::class, 'code_data'])
    ->name('code_data')
    ->middleware('auth');

    Route::get('/code_data/{id_code}/code_edit', [AI_tool_dataController::class, 'code_edit'])
    ->name('code_data.code_edit')
    ->middleware('auth');

    Route::get('/code_data/{id_tool}/code_delete', [AI_tool_dataController::class, 'code_delete'])
    ->name('code_data.code_delete')
    ->middleware('auth');

    Route::post('/code_data/{id_tool}/codesave', [AI_tool_dataController::class, 'codesave'])
    ->name('code_data.codesave')
    ->middleware('auth');

    Route::post('/code_data/{id}/codeedit', [AI_tool_dataController::class, 'codeedit'])
    ->name('code_data.codeedit')
    ->middleware('auth');

    Route::get('/image_data', [AI_tool_dataController::class, 'image_data'])
    ->name('image_data')
    ->middleware('auth');

    Route::post('/image_data/{id_tool}/imagesave', [AI_tool_dataController::class, 'imagesave'])
    ->name('image_data.imagesave')
    ->middleware('auth');

    Route::get('/image_data/{id}/destroy', [AI_tool_dataController::class, 'destroy'])
    ->name('image_data.destroy')
    ->middleware('auth');

    Route::get('/voice_data', [AI_tool_dataController::class, 'voice_data'])
    ->name('voice_data')
    ->middleware('auth');

    Route::get('/voice_data/{id}/destroyVoice', [AI_tool_dataController::class, 'destroyVoice'])
    ->name('voice_data.destroyVoice')
    ->middleware('auth');

    Route::post('/voice_data/{id_tool}/voicesave', [AI_tool_dataController::class, 'voicesave'])
    ->name('voice_data.voicesave')
    ->middleware('auth');
    
    //*************************user
    Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    //darcktheme
    Route::get('/profile/{user}/{darck_state}/darcktheme', [ProfileController::class, 'darcktheme'])->name('profile.darcktheme');
    //update_theme
    Route::get('/profile/{user}/{theme_id}/theme', [ProfileController::class, 'updateTheme'])->name('profile.updateTheme');
    //update_sid_img
    Route::get('/profile/{user}/{sid_img_id}/sid_img', [ProfileController::class, 'updateSideImg'])->name('profile.updateSideImg');
    //update_avatar
    Route::get('/profile/{user}/{avatar}/avatar', [ProfileController::class, 'updateAvatar'])->name('profile.updateAvatar');

    });
    ///////////////Subscription
    Route::get('/Subscription', [SubscriptionController::class, 'index'])
    ->name('Subscription')
    ->middleware('auth');

    Route::post('/Subscription/{id_plan}/Payment', [SubscriptionController::class, 'Payment'])
    ->name('Subscription.Payment')
    ->middleware('auth');

    Route::get('/Subscription/{id_plan}/payment_success', [SubscriptionController::class, 'payment_success'])
    ->name('Subscription.payment_success')
    ->middleware('auth');

    Route::get('/Subscription/payment_failed', [SubscriptionController::class, 'payment_failed'])
    ->name('Subscription.payment_failed')
    ->middleware('auth');

    //*************************admin
    ///////////////Dashboard_admin
    Route::get('/Dashboard_admin', [Dashboard_adminController::class, 'index'])
    ->name('Dashboard_admin')
    ->middleware('auth');

    ///////////////users_admin
    Route::get('/user_manegement_admin', [user_manegement_adminController::class, 'index'])
    ->name('user_manegement_admin')
    ->middleware('auth');

    Route::get('/user_manegement_admin/add_special_user', [user_manegement_adminController::class, 'add_special_user'])
    ->name('user_manegement_admin.add_special_user')
    ->middleware('auth');

    Route::get('/user_manegement_admin/add_admin', [user_manegement_adminController::class, 'add_admin'])
    ->name('user_manegement_admin.add_admin')
    ->middleware('auth');

    Route::get('/user_manegement_admin/{id}/edit_user', [user_manegement_adminController::class, 'edit_user'])
    ->name('user_manegement_admin.edit_user')
    ->middleware('auth');

    Route::get('/user_manegement_admin/{id}/destroy', [user_manegement_adminController::class, 'destroy'])
    ->name('user_manegement_admin.destroy')
    ->middleware('auth');

    Route::get('/user_manegement_admin/{id}/addsubscribe', [user_manegement_adminController::class, 'addsubscribe'])
    ->name('user_manegement_admin.addsubscribe')
    ->middleware('auth');

    Route::get('/user_manegement_admin/{id}/dessubscribe', [user_manegement_adminController::class, 'dessubscribe'])
    ->name('user_manegement_admin.dessubscribe')
    ->middleware('auth');

    ///////////////general_sitting_admin
    Route::get('/general_setting_admin/chatGPT', [general_setting_adminController::class, 'chatGPT'])
    ->name('general_setting_admin.chatGPT')
    ->middleware('auth');

    Route::get('/general_setting_admin/StableDiffusion', [general_setting_adminController::class, 'StableDiffusion'])
    ->name('general_setting_admin.StableDiffusion')
    ->middleware('auth');

    Route::get('/general_setting_admin/STT', [general_setting_adminController::class, 'STT'])
    ->name('general_setting_admin.STT')
    ->middleware('auth');

    Route::get('/general_setting_admin/TTS', [general_setting_adminController::class, 'TTS'])
    ->name('general_setting_admin.TTS')
    ->middleware('auth');

    Route::get('/general_setting_admin/stripe_public_key', [general_setting_adminController::class, 'stripe_public_key'])
    ->name('general_setting_admin.stripe_public_key')
    ->middleware('auth');

    Route::get('/general_setting_admin/stripe_secret_key', [general_setting_adminController::class, 'stripe_secret_key'])
    ->name('general_setting_admin.stripe_secret_key')
    ->middleware('auth');

    Route::get('/general_setting_admin/storeAPI', [general_setting_adminController::class, 'storeAPI'])
    ->name('general_setting_admin.storeAPI')
    ->middleware('auth');
    
    ///////////////Blogs
    Route::get('/Blogs_admin', [Blogs_adminController::class, 'index'])
    ->name('Blogs_admin')
    ->middleware('auth');

    Route::get('/Blogs_admin/show_to_create', [Blogs_adminController::class, 'show_to_create'])
    ->name('Blogs_admin.show_to_create')
    ->middleware('auth');

    Route::get('/Blogs_admin/{id}/show_to_edit', [Blogs_adminController::class, 'show_to_edit'])
    ->name('Blogs_admin.show_to_edit')
    ->middleware('auth');

    Route::post('/Blogs_admin/store', [Blogs_adminController::class, 'store'])
    ->name('Blogs_admin.store')
    ->middleware('auth');

    Route::post('/Blogs_admin/{id}/edit', [Blogs_adminController::class, 'edit'])
    ->name('Blogs_admin.edit')
    ->middleware('auth');

    Route::get('/Blogs_admin/{id}/destroy', [Blogs_adminController::class, 'destroy'])
    ->name('Blogs_admin.destroy')
    ->middleware('auth');

    ///////////////Finance_admin
    Route::get('/Finance_admin/plane', [Finance_adminController::class, 'index'])
    ->name('Finance_admin.plane')
    ->middleware('auth');

    Route::get('/Finance_admin/{id}/edit_plan', [Finance_adminController::class, 'edit_plan'])
    ->name('Finance_admin.edit_plan')
    ->middleware('auth');

    Route::get('/Finance_admin/{id}/destroy', [Finance_adminController::class, 'destroy'])
    ->name('Finance_admin.destroy')
    ->middleware('auth');

    Route::get('/Finance_admin/subscribers', [Finance_adminController::class, 'subscribers'])
    ->name('Finance_admin.subscribers')
    ->middleware('auth');

});


require __DIR__.'/auth.php';
