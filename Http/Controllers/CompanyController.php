<?php

namespace Modules\Dashboard\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Dashboard\Entities\Company;
use Modules\Dashboard\Http\Requests\Company\CompanyRequest;
use Illuminate\Http\Request;

class CompanyController extends Controller
{

    public function edit($tab)
    {
        return view('dashboard::companies.edit', ['tab' => $tab]);
    }

    public function update(CompanyRequest $request, Company $company)
    {
        (Company::get())->update($request->all());
        return back()->with('success', 'Informações da empresa atualizado com sucesso.');
    }

    public function logo(Request $request){
        $request->file->store('companies/logo/', 'public');
        (Company::get())->update(['logo' => 'storage/companies/logo/'. $request->file->hashName()]);
    }

}
