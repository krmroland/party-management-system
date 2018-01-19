<?php

namespace App;

class Card extends BaseModel
{
    /**
     * append the full name.
     *
     * @var array
     */
    protected $appends = ['fullName'];

    /**
     * Gets all.
     *
     * @return \Illuminate\Support\Collection all
     */
    public static function getAll()
    {
        return static::latest('issued_on')->get();
    }

    /**
     * initial data.
     *
     * @return \Illuminate\Support\Collection
     */
    public static function initialData()
    {
        return collect([
            'cards' => static::getAll(),
            'initials' => static::getInitials(),
            'issuers' => static::issuers(),
        ]);
    }

    /**
     * carders responsible for issuing cards.
     *
     * @return array
     */
    public static function issuers()
    {
        return [
            'Ayebare Justus',
            'Kabatereine Rodgers',
            'Nyinabajungu Buradina',
            'Mbaasa Richard',
        ];
    }

    /**
     * Gets the initials.
     *
     * @return array
     */
    public static function getInitials()
    {
        return[
            'Mr. & Mrs.', 'Mr', 'Mrs.', 'Rev.', 'Hon.',
        ];
    }

    /**
     * Gets the full name attribute.
     *
     * @return string the full name attribute
     */
    public function getFullNameAttribute()
    {
        return "$this->initials $this->name";
    }

    /**
     * Gets the issued on attribute.
     *
     * @param string $issued_on
     *
     * @return string
     */
    public function getIssuedOnAttribute($issued_on)
    {
        return $this->asDate($issued_on)->format('d-M-Y');
    }
}
