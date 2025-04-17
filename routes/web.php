<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ClassSubjectController;
use App\Http\Controllers\Admin\FeeStructureController;
use App\Http\Controllers\Admin\SchoolClassController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\Admin\StudentAttendanceController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\FeePaymentController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use Illuminate\Routing\Route as RoutingRoute;
use Illuminate\Support\Facades\Route;


Route::get('/',[AuthController::class, 'loginPage'])->name('login');

Route::group(['middleware' => 'auth'], function(){
    Route::get('/home',[HomeController::class, 'redirect'])->name('redirect');
    Route::get('/view-profile/{id}',[HomeController::class, 'viewProfile'])->name('profile.view');
    Route::get('/edit-profile/{id}',[HomeController::class, 'editProfile'])->name('profile.edit');
    Route::put('/update-profile/{id}',[HomeController::class, 'updateProfile'])->name('profile.update');
    Route::get('fee-structure',[HomeController::class, 'viewFeeStructure'])->name('frontend.feeStructure');
    
    Route::get('my-class/{id}',[HomeController::class, 'ShowMyClass'])->name('student.myClass');
    Route::get('change-password/{student}',[ChangePasswordController::class, 'changePassword'])->name('student.changePassword');
    Route::put('password-reset/{id}',[ChangePasswordController::class, 'passwordReset'])->name('student.resetPassword');
});


// authentication 
Route::prefix('auth/')->group(function(){
    Route::get('signup',[AuthController::class, 'signupPage'])->name('signup');
    Route::post('store-user',[AuthController::class, 'postSignup'])->name('signup.store');
    
    Route::get('login',[AuthController::class, 'loginPage'])->name('login');
    Route::post('store-login',[AuthController::class, 'postLogin'])->name('login.store');
    Route::get('logout',[AuthController::class, 'logout'])->name('logout');
});


// permissions controller 

// Route::group(['middleware' => ['auth', 'role:super-admin']], function(){
Route::group(['middleware' => ['role:super-admin|admin']], function(){
    
    Route::get('roles-and-permissions', [PermissionController::class, 'roles_and_permissions'])->name('roles_and_permissions');

    // Route::resource('permissions', PermissionController::class);
    Route::get('permissions', [PermissionController::class, 'index'])->middleware('permission:view permission');
    Route::get('permissions/create', [PermissionController::class, 'create'])->middleware('permission:create permission');
    Route::post('permissions', [PermissionController::class, 'store']);
    Route::get('permissions/{permission}/edit', [PermissionController::class, 'edit'])->middleware('permission:update permission');
    Route::put('permissions/{permission}', [PermissionController::class, 'update']);
    Route::delete('permissions/{permission}', [PermissionController::class, 'destroy'])->middleware('permission:delete permission');

    // roles
    Route::get('roles', [RoleController::class, 'index'])->middleware('permission:view role');
    Route::get('roles/create', [RoleController::class, 'create'])->middleware('permission:create role');
    Route::post('roles', [RoleController::class, 'store']);
    Route::get('roles/{role}/edit', [RoleController::class, 'edit'])->middleware('permission:update role');
    Route::put('roles/{role}', [RoleController::class, 'update']);

    Route::delete('roles/{role}', [RoleController::class, 'destroy'])->middleware('permission:delete role');
    
    Route::get('roles/{roleId}/give-permissions', [RoleController::class, 'add_permission_to_role'])->middleware('permission:add-permission-to-role');
    Route::put('roles/{roleId}/give-permissions', [RoleController::class, 'give_permission_to_role']);



    
    
});

Route::get('fee-payment/view', [FeePaymentController::class, 'view'])->name('feePayment.view')->middleware('permission:view fee payment');
Route::get('collect-fee-form', [FeePaymentController::class, 'collectFeeform'])->name('feePayment.form')->middleware('permission:add fee payment');
Route::post('collect-fee', [FeePaymentController::class, 'collectFee'])->name('feePayment.collect')->middleware('permission:add fee payment');
Route::get('fee-payment/generateChallan/{paymentId}', [FeePaymentController::class, 'downloadChallan'])->name('feePayment.challan')->middleware('permission:download fee challan');


Route::get('/view-leaves', [LeaveController::class, 'index'])->name('leaves.view');
Route::get('/leave-form', [LeaveController::class, 'add'])->name('leave.add');
Route::post('/store-form', [LeaveController::class, 'store'])->name('leave.store');
Route::put('/update-status/{leaveId}', [LeaveController::class, 'update'])->name('leave.update.status');
Route::get('/view-leave-detail/{leave}', [LeaveController::class, 'show'])->name('leave.detail');
Route::delete('/destory-leave/{leave}', [LeaveController::class, 'destroy'])->name('leave.destroy');







// Route::prefix('Admin/')->group(function(){
Route::prefix('e-learning/')->middleware('auth')->group(function(){

    Route::get('dashboard',[AdminController::class, 'dashboard'])->name('dashboard');

    Route::get('view-users',[UserController::class, 'view'])->name('admin.users.data')->middleware('permission:view user');
    Route::get('add-user',[UserController::class, 'Add'])->name('admin.user.add')->middleware('permission:add user');
    Route::post('store-user',[UserController::class, 'store'])->name('admin.user.store');
    Route::get('view-user-detail/{id}',[UserController::class, 'show'])->name('admin.user.view')->middleware('permission:show user');;
    Route::get('edit-user/{id}',[UserController::class, 'edit'])->name('admin.user.edit')->middleware('permission:update user');
    Route::put('update-user/{id}',[UserController::class, 'update'])->name('admin.user.update');
    Route::delete('destory-user/{id}',[UserController::class, 'destroy'])->name('admin.user.destroy')->middleware('permission:delete user');
    Route::put('update-user-status/{id}',[UserController::class, 'updateStatus'])->name('status.update')->middleware('permission:update-user-status');
    
    Route::get('view-classes',[SchoolClassController::class, 'view'])->name('admin.classes.view')->middleware('permission:view class');
    Route::get('add-class',[SchoolClassController::class, 'add'])->name('admin.class.add')->middleware('permission:add class');
    Route::post('store-class',[SchoolClassController::class, 'store'])->name('admin.class.store');
    Route::get('edit-class/{id}',[SchoolClassController::class, 'edit'])->name('admin.class.edit')->middleware('permission:update class');
    Route::put('update-class/{id}',[SchoolClassController::class, 'update'])->name('admin.class.update');
    Route::delete('destory-class/{id}',[SchoolClassController::class, 'destroy'])->name('admin.class.destroy')->middleware('permission:delete class');

    Route::get('view-sections',[SectionController::class, 'view'])->name('admin.sections.view')->middleware('permission:view section');
    Route::get('add-section',[SectionController::class, 'add'])->name('admin.section.add')->middleware('permission:add section');
    Route::post('store-section',[SectionController::class, 'store'])->name('admin.section.store');
    Route::get('edit-section/{id}',[SectionController::class, 'edit'])->name('admin.section.edit')->middleware('permission:update section');
    Route::put('update-section/{id}',[SectionController::class, 'update'])->name('admin.section.update');
    Route::delete('destory-section/{id}',[SectionController::class, 'destroy'])->name('admin.section.destroy')->middleware('permission:delete section');

    Route::get('view-students', [StudentController::class, 'view'])->name('admin.students.data')->middleware('permission:view student');
    Route::get('add-student', [StudentController::class, 'add'])->name('admin.student.add')->middleware('permission:add student');
    Route::post('store-student', [StudentController::class, 'store'])->name('admin.student.store');
    Route::get('view-student-details/{id}', [StudentController::class, 'show'])->name('admin.student.view')->middleware('permission:show student details');
    Route::get('edit-student/{id}', [StudentController::class, 'edit'])->name('admin.student.edit')->middleware('permission:update student');
    Route::put('update-student/{id}', [StudentController::class, 'update'])->name('admin.student.update');
    Route::delete('destory-student/{id}',[StudentController::class, 'destroy'])->name('admin.student.destroy')->middleware('permission:delete student');
    Route::put('update-student-status/{id}',[StudentController::class, 'updateStatus'])->name('student.status.update')->middleware('permission:update-student-status');
    Route::get('generate-student-report/{id}', [StudentController::class, 'generateReport'])->name('admin.student.generateReport')->middleware('permission:generate-student-report');
    Route::post('store-student-report/{id}', [StudentController::class, 'storeAndSend'])->name('admin.student.send-report');

    Route::get('view-staff', [StaffController::class, 'view'])->name('admin.staff.view')->middleware('permission:view staff');
    Route::get('view-staff-details/{id}', [StaffController::class, 'show'])->name('admin.staff.show');
    
    Route::get('view-fee-structures', [FeeStructureController::class, 'view'])->name('admin.fee.view')->middleware('permission:view fee structure');
    Route::get('add-fee-structure', [FeeStructureController::class, 'add'])->name('admin.fee.add')->middleware('permission:add fee structure');
    Route::post('store-fee-structure', [FeeStructureController::class, 'store'])->name('admin.fee.store');
    Route::get('edit-fee-structure/{feeStructure}', [FeeStructureController::class, 'edit'])->name('admin.fee.edit')->middleware('permission:update fee structure');
    Route::put('update-fee-structure/{feeStructure}', [FeeStructureController::class, 'update'])->name('admin.fee.update');
    Route::delete('destroy-fee-structure/{feeStructure}', [FeeStructureController::class, 'destroy'])->name('admin.fee.destroy')->middleware('permission:delete fee structure');

  
    Route::get('view-subjects', [SubjectController::class, 'view'])->name('subjects.view')->middleware('permission:view subject');
    Route::get('subject-add', [SubjectController::class, 'add'])->name('subject.add')->middleware('permission:add subject');
    Route::post('subject-store', [SubjectController::class, 'store'])->name('subject.store');
    // Route::put('update-status/{subjectId}', [SubjectController::class, 'updateStatus'])->name('subject.update.status');
    Route::get('edit-subject/{subject}', [SubjectController::class, 'edit'])->name('subject.edit')->middleware('permission:update subject');
    Route::put('update-subject/{subject}', [SubjectController::class, 'update'])->name('subject.update');
    Route::delete('subject-destory/{subject}', [SubjectController::class, 'destroy'])->name('subject.destroy')->middleware('permission:delete subject');

    Route::get('add-attendance',[StudentAttendanceController::class, 'index'])->name('admin.student.attendance')->middleware('permission:add attendance');
    Route::get('mark-attendance/subject={subjectName}/{subjectId}',[StudentAttendanceController::class, 'add'])->name('admin.student.mark-attendance')->middleware('permission:mark attendance');
    Route::post('store-attendance/{subjectId}',[StudentAttendanceController::class, 'store'])->name('admin.student.attendance.store');

    
    Route::get('Assign-subjects-to-class', [ClassSubjectController::class, 'add'])->name('class_subject.assign')->middleware('permission:assign-subject-to-class');
    Route::post('store-Assign-subjects-to-class', [ClassSubjectController::class, 'store'])->name('class_subject.assign.store');
    
    
});
