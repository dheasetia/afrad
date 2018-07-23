<?php

namespace App\Http\Controllers;

use App\Address;
use App\Area;
use App\Bank;
use App\Beneficiary;
use App\City;
use App\Document;
use App\EducationSpecialty;
use App\Employee;
use App\Expense;
use App\Expertise;
use App\FamilyRole;
use App\Graduation;
use App\Guardian;
use App\Http\Requests\BeneficiaryPostRequest;
use App\Http\Requests\BeneficiaryUpdateRequest;
use App\Http\Requests\DocumentPostRequest;
use App\Http\Requests\ResidentPostRequest;
use App\Income;
use App\ItemNeed;
use App\Job;
use App\MaritalStatus;
use App\MoneyNeed;
use App\Nationality;
use App\Profession;
use App\Classes\HijriCalendar;
use App\Research;
use App\ResearchKind;
use App\Resident;
use App\ResidentKind;
use App\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image;

class BeneficiaryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('user_active');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $beneficiaries = Beneficiary::all();
        return view('beneficiaries.beneficiary_index', compact('beneficiaries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $marital_statuses = MaritalStatus::all('id', 'status');
        $family_roles = FamilyRole::all('id', 'role');
        $jobs = Job::all(['id', 'job']);
        $expertises = Expertise::all(['id', 'expertise']);
        $professions = Profession::all(['id', 'profession']);
        $graduations = Graduation::all(['id', 'graduation']);
        $education_specialties = EducationSpecialty::all(['id', 'specialty']);
        $guardians = Guardian::all(['id', 'name']);
        $banks = Bank::all(['id', 'bank']);
        $nationalities = Nationality::all(['id', 'nationality']);

        return view('beneficiaries.beneficiary_create', compact('marital_statuses', 'jobs', 'expertises', 'graduations', 'education_specialties', 'guardians', 'banks', 'family_roles', 'professions', 'nationalities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\BeneficiaryPostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BeneficiaryPostRequest $request)
    {
        $beneficiary = new Beneficiary([
            'name'  =>  $request->name,
            'parent_id'  =>  $request->parent_id,
            'mobile'  =>  $request->mobile,
            'phone'  =>  $request->phone,
            'national_number'  =>  $request->national_number,
            'nationality_id'  =>  $request->nationality_id,
            'email'  =>  $request->email,
            'sex'  =>  $request->sex,
            'marital_status_id'  =>  $request->marital_status_id,
            'family_role_id'  =>  $request->family_role_id,
            'family_member_count'  =>  $request->family_member_count,
            'son_count'  =>  $request->son_count,
            'daughter_count'  =>  $request->daughter_count,
            'expertise_id'  =>  $request->expertise_id,
            'social_status_id'  =>  $request->social_status_id,
            'graduation_id'  =>  $request->graduation_id,
            'education_specialty_id'  =>  $request->education_specialty_id,
            'work_experience'  =>  $request->work_experience,
            'profession_id'  =>  $request->profession_id,
            'company_name'  =>  $request->company_name,
            'guardian_id'  =>  $request->guardian_id,
            'bank_id'  =>  $request->bank_id,
            'iban'  =>  $request->iban,
            'notes' =>  $request->notes
        ]);

        if ($request->dob != '') {
            $hijri = new HijriCalendar();
            $hijri_numbers = explode('/ ', $request->dob);
            $hijri_day = $hijri_numbers[0];
            $hijri_month = $hijri_numbers[1];
            $hijri_year = $hijri_numbers[2];
            $gregorian_in_array = $hijri->u2g(intval($hijri_day), intval($hijri_month), intval($hijri_year));
            $gregorian_in_string = $gregorian_in_array['year'] . '-' . str_pad($gregorian_in_array['month'], 2, '0', STR_PAD_LEFT) . '-' . str_pad($gregorian_in_array['day'], 2, '0', STR_PAD_LEFT);
            $beneficiary->dob = $gregorian_in_string;
            $beneficiary->dob_hijri_day = $hijri_day;
            $beneficiary->dob_hijri_month = $hijri_month;
            $beneficiary->dob_hijri_year = $hijri_year;
        }

        $beneficiary->save();
        return redirect(url('beneficiaries', $beneficiary->id));

    }


    /**
     * Display the specified resource.
     *
     * @param  \App\beneficiary  $beneficiary
     * @return \Illuminate\Http\Response
     */
    public function show(beneficiary $beneficiary)
    {
        $marital_statuses = MaritalStatus::all('id', 'status');
        $family_roles = FamilyRole::all('id', 'role');
        $jobs = Job::all(['id', 'job']);
        $expertises = Expertise::all(['id', 'expertise']);
        $professions = Profession::all(['id', 'profession']);
        $graduations = Graduation::all(['id', 'graduation']);
        $education_specialties = EducationSpecialty::all(['id', 'specialty']);
        $guardians = Guardian::all(['id', 'name']);
        $banks = Bank::all(['id', 'bank']);
        $nationalities = Nationality::all(['id', 'nationality']);
        $researches = $beneficiary->researches;
        $cities = City::all('id', 'city');
        $areas = Area::all('id', 'area');
        $address = $beneficiary->address;
        $resident = $beneficiary->resident;
        $resident_kinds = ResidentKind::all('id', 'kind');
        $documents = Document::where('beneficiary_id', $beneficiary->id)->get();
        $last_research = $beneficiary->researches->last();
        $percentage = 0;
        $monthly_need = 0;
        if (count($last_research) > 0) {
            $percentage = $last_research->percentage;
            $monthly_need = $last_research->difference;
        }
        return view('beneficiaries.beneficiary_show',
            compact('beneficiary','marital_statuses', 'jobs', 'expertises', 'graduations', 'education_specialties',
                'guardians', 'banks', 'family_roles', 'professions', 'nationalities', 'researches', 'cities',
                'monthly_need', 'percentage', 'address', 'resident', 'resident_kinds', 'areas', 'documents'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\beneficiary  $beneficiary
     * @return \Illuminate\Http\Response
     */
    public function edit(beneficiary $beneficiary)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\beneficiary  $beneficiary
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, beneficiary $beneficiary)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\beneficiary  $beneficiary
     * @return \Illuminate\Http\Response
     */
    public function destroy(beneficiary $beneficiary)
    {
        //
    }

    public function prepare_avatar($id)
    {
        $beneficiary = Beneficiary::find($id);
        if (count($beneficiary) == 0) {
            return abort(404);
        }
        return view('beneficiaries.avatars.avatar_prepare', compact('beneficiary'));
    }

    public function store_avatar(Request $request, $id)
    {
        $beneficiary = Beneficiary::findOrFail($id);
        if($request->hasFile('avatar')){
            $document = $request->file('avatar');
            $destination_path = public_path('files/beneficiaries/avatars');
            $file_name = time() . '_' . $document->getClientOriginalName();
            if($document->move($destination_path, $file_name)){
                $beneficiary->avatar = $file_name;
                $beneficiary->save();
            }
            $x = intval($request->x);
            $y = intval($request->y);

            Image::make($destination_path . '/' . $file_name)
                ->crop(300, 300, $x, $y)
                ->save($destination_path .  '/thumbnails/' . 'thumb_' . $file_name);
            return redirect(url('beneficiaries', $beneficiary->id));
        }
        return redirect()->back();
    }

    public function create_address($id)
    {
        $beneficiary = Beneficiary::findOrFail($id);
        if (count($beneficiary->address) > 0) {
            return redirect(url('beneficiaries', $beneficiary->id));
        }
        $cities = City::all('id', 'city');
        $address = $beneficiary->address;
        $areas = Area::all('id', 'area');
        return view('addresses.address_create', compact('beneficiary', 'cities', 'address', 'areas'));
    }

    public function create_resident($id)
    {
        $beneficiary = Beneficiary::findOrFail($id);
        if (count($beneficiary->resident) > 0) {
            return redirect(url('beneficiaries', $beneficiary->id));
        }

        $resident_kinds = ResidentKind::all('id', 'kind');
        $banks = Bank::all('id', 'bank');

        return view('residents.resident_create', compact('beneficiary', 'resident_kinds', 'banks'));
    }

    public function create_research($id)
    {
        $beneficiary = Beneficiary::findOrFail($id);
        $incomes = Income::all(['id', 'income']);
        $expenses = Expense::all(['id', 'expense']);
        $money_needs = MoneyNeed::all(['id', 'description']);
        $item_needs = ItemNeed::all(['id', 'item']);
        $employees = Employee::all('id', 'name');
        $researcher = Auth::user();
        $research_kinds = ResearchKind::all('id', 'kind');
        $setting = Setting::first();
        return view('beneficiaries.beneficiary_research_create', compact('beneficiary', 'incomes', 'expenses', 'money_needs', 'item_needs', 'employees', 'researcher', 'research_kinds', 'setting'));
    }

    public function create_document($id)
    {
        $beneficiary = Beneficiary::findOrFail($id);
        return view('documents.document_create', compact('beneficiary'));
    }

    public function store_address(Request $request, $id)
    {
        $beneficiary = Beneficiary::findOrFail($id);

        $address = new Address();
        $address->city_id = $request->city_id;
        $address->building_name = $request->building_name;
        $address->street = $request->street;
        $address->district = $request->district;
        $address->building_no = $request->building_no;
        $address->additional_no = $request->additional_no;
        $address->po_box = $request->po_box;
        $address->zip_code = $request->zip_code;
        $address->coordinate = $request->coordinate;
        $address->save();

        $beneficiary->address_id = $address->id;
        $beneficiary->save();

        return redirect(url('beneficiaries', $id) . '?tab_active=address');
    }

    public function store_resident(ResidentPostRequest $request, $id)
    {
        $beneficiary = Beneficiary::findOrFail($id);

        $resident = new Resident();
        $resident->resident_kind_id = $request->resident_kind_id;
        $resident->owner = $request->owner;
        $resident->responsible_person = $request->responsible_person;
        $resident->mobile = $request->mobile;
        $resident->phone = $request->phone;
        $resident->fax = $request->fax;
        $resident->email = $request->email;
        $resident->bank_id = $request->bank_id;
        $resident->iban = $request->iban;
        $resident->payment_way = $request->payment_way;
        $resident->annually_cost = $request->annually_cost;
        $resident->description = $request->description;

        $resident->save();
        $beneficiary->resident_id = $resident->id;
        $beneficiary->save();

        return redirect(url('beneficiaries', $beneficiary->id) . '?tab_active=resident');
    }

    public function store_document(DocumentPostRequest $request, $id)
    {
        $beneficiary = Beneficiary::findOrFail($id);
        $document = new Document();
        $document->beneficiary_id = $beneficiary->id;
        $document->label = $request->label;
        if ($request->hijri_expiry_date != '') {
            $hijri = new HijriCalendar();
            $hijri_numbers = explode('/ ', $request->hijri_expiry_date);
            $hijri_day = $hijri_numbers[0];
            $hijri_month = $hijri_numbers[1];
            $hijri_year = $hijri_numbers[2];
            $gregorian_in_array = $hijri->u2g(intval($hijri_day), intval($hijri_month), intval($hijri_year));
            $gregorian_in_string = $gregorian_in_array['year'] . '-' . str_pad($gregorian_in_array['month'], 2, '0', STR_PAD_LEFT) . '-' . str_pad($gregorian_in_array['day'], 2, '0', STR_PAD_LEFT);

            $document->expiry_date = $gregorian_in_string;
            $document->expiry_hijri_day = $hijri_day;
            $document->expiry_hijri_month = $hijri_month;
            $document->expiry_hijri_year = $hijri_year;
        }

        if($request->hasFile('path')){
            $path = $request->file('path');
            $destination_path = public_path('files/beneficiaries/documents');
            $file_name = time() . '_' . $path->getClientOriginalName();
            if($path->move($destination_path, $file_name)){
                $document->path = $file_name;
                $document->extension = $path->getExtension();
            }
        }

        $document->save();

        return redirect(url('beneficiaries', $beneficiary->id) . '?tab_active=documents');

    }

    //====== AJAX =======//
    public function ajax_show(Request $request)
    {
        $beneficiary = Beneficiary::findOrFail($request->ben_id);

        $result = [
                    'national_number'   => $beneficiary->national_number,
                    'nationality'       => $beneficiary->nationality != '' ? $beneficiary->nationality->nationality : '' ,
                    'marital_status'    => $beneficiary->marital_status != '' ? $beneficiary->marital_status->status : '',
                    'family_member_count'   => $beneficiary->family_member_count,
                    'son_count'         => $beneficiary->son_count,
                    'daughter_count'    => $beneficiary->daughter_count
                ];

        return response()->json($result);
    }

    public function ajax_update(BeneficiaryUpdateRequest $request, $id)
    {
        if ($request->beneficiary_id !== $id) {
            return response()->json([
                'message'   => 'لا يوجد المستفيد المطلوب',
                'status'    => 'fail',
                'beneficiary_id' => $request->beneficiary_id,
                'id'    => $id
            ]);
        }
        $beneficiary = Beneficiary::findOrFail($request->beneficiary_id);

        if ($request->dob != '') {
            $hijri = new HijriCalendar();
            $hijri_numbers = explode('/ ', $request->dob);
            $hijri_day = $hijri_numbers[0];
            $hijri_month = $hijri_numbers[1];
            $hijri_year = $hijri_numbers[2];
            $gregorian_in_array = $hijri->u2g(intval($hijri_day), intval($hijri_month), intval($hijri_year));
            $gregorian_in_string = $gregorian_in_array['year'] . '-' . str_pad($gregorian_in_array['month'], 2, '0', STR_PAD_LEFT) . '-' . str_pad($gregorian_in_array['day'], 2, '0', STR_PAD_LEFT);
            $beneficiary->dob = $gregorian_in_string;
            $beneficiary->dob_hijri_day = $hijri_day;
            $beneficiary->dob_hijri_month = $hijri_month;
            $beneficiary->dob_hijri_year = $hijri_year;
        }

        $beneficiary->name  =  $request->name;
        $beneficiary->parent_id  =  $request->parent_id;
        $beneficiary->mobile  =  $request->mobile;
        $beneficiary->phone  =  $request->phone;
        $beneficiary->national_number  =  $request->national_number;
        $beneficiary->nationality_id  =  $request->nationality_id;
        $beneficiary->email  =  $request->email;
        $beneficiary->sex  =  $request->sex;
        $beneficiary->marital_status_id  =  $request->marital_status_id;
        $beneficiary->family_role_id  =  $request->family_role_id;
        $beneficiary->family_member_count  =  $request->family_member_count;
        $beneficiary->son_count  =  $request->son_count;
        $beneficiary->daughter_count  =  $request->daughter_count;
        $beneficiary->expertise_id  =  $request->expertise_id;
        $beneficiary->social_status_id  =  $request->social_status_id;
        $beneficiary->graduation_id  =  $request->graduation_id;
        $beneficiary->education_specialty_id  =  $request->education_specialty_id;
        $beneficiary->work_experience  =  $request->work_experience;
        $beneficiary->profession_id  =  $request->profession_id;
        $beneficiary->company_name  =  $request->company_name;
        $beneficiary->guardian_id  =  $request->guardian_id;
        $beneficiary->bank_id  =  $request->bank_id;
        $beneficiary->iban  =  $request->iban;
        $beneficiary->notes =  $request->note;

        $beneficiary->save();
        return response()->json([
            'status'    => 'success',
            'message'   => 'تم تحديث بيانات المستفيد',
            'beneficiary'   => $beneficiary],
            200);
    }

}
