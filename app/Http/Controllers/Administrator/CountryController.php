<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Http\Requests\Administrator\Country\CountryFilterRequest;
use App\Http\Requests\Administrator\Country\CountryFormRequest;
use App\Models\Country;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CountryController extends Controller
{

    /**
     * Country controller construct.
     */
    public function __construct()
    {
        parent::__construct('administrator');
    }

    /**
     * Country list controller.
     *
     * @param CountryFilterRequest $request The country filter request.
     * @return View The country list page view.
     */
    public function index(CountryFilterRequest $request): View
    {
        $countryFilterData = $request->validated();

        $countries = Country::when($countryFilterData['status'] ?? '', function ($query) use ($countryFilterData) {
            if ('ENABLE' == $countryFilterData['status']) {
                return $query->whereNotNull('activated_at');
            } else if ('DISABLE' == $countryFilterData['status']) {
                return $query->whereNull('activated_at');
            } else if ('TRASHED' == $countryFilterData['status']) {
                return $query->onlyTrashed();
            } else {
                return $query;
            }
        })
            ->when($countryFilterData['name'] ?? '', function ($query) use ($countryFilterData) {
                return $query->where('name', 'LIKE', '%' . $countryFilterData['name'] . '%');
            })
            ->when($countryFilterData['code'] ?? '', function ($query) use ($countryFilterData) {
                return $query->where('code', 'LIKE', '%' . $countryFilterData['code'] . '%');
            })
            ->when($countryFilterData['phone_code'] ?? '', function ($query) use ($countryFilterData) {
                return $query->where('phone_code', 'LIKE', '%' . $countryFilterData['phone_code'] . '%');
            })
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view($this->profile . '.dashboard.country.index', ['countries' => $countries, 'input' => $request]);
    }

    /**
     * Create country form controller.
     *
     * @return View The create country form package view.
     */
    public function createForm(): View
    {
        $country = new Country();
        return view($this->profile . '.dashboard.country.form', ['country' => $country]);
    }

    /**
     * Create country traitement controller.
     *
     * @param CountryFormRequest $request The country form request.
     * @return RedirectResponse The redirect response.
     */
    public function create(CountryFormRequest $request): RedirectResponse
    {
        $countryData = $request->validated();

        Country::create([
            'name' => ucfirst($countryData['name']),
            'code' => strtoupper($countryData['code']),
            'phone_code' => '+' . $countryData['phone_code'],
        ]);

        return redirect()->route($this->profile . '.country.index')->with(['success' => 'Nouveau pays ajouté avec succès.']);
    }

    /**
     * Update country form controller.
     *
     * @return View The update country form package view.
     */
    public function updateForm(Country $country): View
    {
        return view($this->profile . '.dashboard.country.form', ['country' => $country]);
    }

    /**
     * Update country traitement controller.
     *
     * @param CountryFormRequest $request The country form request.
     * @param Country $country The country.
     * @return RedirectResponse The redirect response.
     */
    public function update(CountryFormRequest $request, Country $country): RedirectResponse
    {
        $countryData = $request->validated();

        $country->name = ucfirst($countryData['name']);
        $country->code = strtoupper($countryData['code']);
        $country->phone_code = '+' . $countryData['phone_code'];
        $country->update();

        return redirect()->route($this->profile . '.country.index')->with(['success' => 'Pays modifié avec succès.']);
    }

    /**
     * Enable or disable country traitement controller.
     *
     * @param Country $country The country.
     * @param string $new_status The country new status.
     * @return RedirectResponse The redirect response.
     */
    public function enableDisable(Country $country, string $new_status): RedirectResponse
    {
        if ($new_status != 'disable' && $new_status != 'enable') {
            return back()->withErrors(['Une action inattendue bloque le processus.']);
        }

        $old_status = (is_null($country->activated_at)) ? 'disable' : 'enable';

        if ($new_status != $old_status && 'disable' == $new_status) {
            $country->activated_at = NULL;
            $country->update();
        } else if ($new_status != $old_status && 'enable' == $new_status) {
            $country->activated_at = now();
            $country->update();
        }

        $toDo = ($new_status == 'disable') ? 'désactivé' : 'activé';

        return redirect()->route($this->profile . '.country.index')->with(['success' => __('Le pays :country a été :to-do avec succès.', ['country' => $country->name, 'to-do' => $toDo])]);
    }

    /**
     * Delete country traitement controller.
     *
     * @param Country $country The country.
     * @return RedirectResponse The redirect response.
     */
    public function delete(Country $country): RedirectResponse
    {
        $country->delete();
        return redirect()->route($this->profile . '.country.index')->with(['success' => __('Le pays :country a été supprimé avec succès.', ['country' => $country->name])]);
    }

}
