<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;

trait CompanyUserTrait
{
    /**
     * Many-to-Many relations with the user model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function companies()
    {
        return $this->belongsToMany('\App\Models\Company', 'company_user', 'user_id', 'company_id');
    }

    /**
     * Return Current Company of User
     *
     * @return Company
     */
    public function currentCompany()
    {
        return $this->companies()->exists()
            ? $this->companies()->first()
            : null;
    }

    /**
     * @return mixed
     */
    public function ownedCompanies()
    {
        return $this->companies()->where("owner_id", "=", $this->getKey());
    }

    /**
     * Boot the user model
     * Attach event listener to remove the many-to-many records when trying to delete
     * Will NOT delete any records if the user model uses soft deletes.
     *
     * @return void|bool
     */
    public static function bootCompanyUserTrait()
    {
        static::deleting(function (Model $user) {
            if (!method_exists('App\Models\User', 'bootSoftDeletes')) {
                $user->companies()->sync([]);
            }
            return true;
        });
    }

    /**
     * @param $company
     * @return mixed
     */
    protected function retrieveCompanyId($company)
    {
        if (is_object($company)) {
            $company = $company->getKey();
        }
        if (is_array($company) && isset($company["id"])) {
            $company = $company["id"];
        }
        return $company;
    }

    /**
     * Alias to eloquent many-to-many relation's attach() method.
     *
     * @param mixed $team
     * @param array $pivotData
     * @return $this
     */
    public function attachCompany($company, $pivotData = [])
    {
        $company = $this->retrieveCompanyId($company);
    
        // Reload relation
        $this->load('companies');

        if (!$this->companies->contains($company)) {
            $this->companies()->attach($company, $pivotData);
            if ($this->relationLoaded('companies')) {
                $this->load('companies');
            }
        }
        return $this;
    }

    /**
     * Alias to eloquent many-to-many relation's detach() method.
     *
     * @param mixed $team
     * @return $this
     */
    public function detachCompany($company)
    {
        $company = $this->retrieveCompanyId($company);
        $this->companies()->detach($company);

        if ($this->relationLoaded('companies')) {
            $this->load('companies');
        }

        return $this;
    }
}
