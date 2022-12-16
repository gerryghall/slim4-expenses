<?php

namespace App\Domain\Claim\Data;

use Cake\Chronos\Date;

/**
 * DTO.
 */
class ClaimItem
{
    public ?int $id = null;

    public ?int $participantId = null;

    public ?string $claimDate = null;

    public ?string $visitDate = null;

    public ?int $siteNumber = null;

    public ?int $studyReference = null;

    public function __construct(array $claim = [])
    {
        $this->id = $claim['id'];
        $this->participantId = $claim['participant_id'];
        $this->claimDate = (new Date($claim['claim_date']))->format('Y/m/d');
        $this->visitDate = (new Date($claim['visit_date']))->format('Y/m/d');
        $this->siteNumber = $claim['site_number'];
        $this->studyReference = $claim['study_reference'];

        return $this;
    }

    public function toRow(): array
    {
        $claim = [];
        $claim['id'] = $this->id;
        $claim['participant_id'] = $this->participantId;
        $claim['claim_data'] = $this->claimDate;
        $claim['visit_data'] = $this->visitDate;
        $claim['site_number'] = $this->siteNumber;
        $claim['study_reference'] = $this->studyReference;

        return $claim;
    }
}
