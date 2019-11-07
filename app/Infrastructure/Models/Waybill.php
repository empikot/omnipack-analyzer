<?php
namespace App\Infrastructure\Models;

class Waybill
{
    /**
     * @var string
     */
    private $speditor;
    /**
     * @var string
     */
    private $waybillNumber;
    /**
     * @var float
     */
    private $amount;
    /**
     * @var string
     */
    private $clientName;
    /**
     * @var string
     */
    private $orderNumber;

    public function __construct(
        string $speditor,
        string $waybillNumber,
        float $amount,
        string $clientName,
        string $orderNumber
    ) {
        $this->speditor = $speditor;
        $this->waybillNumber = $waybillNumber;
        $this->amount = $amount;
        $this->clientName = $clientName;
        $this->orderNumber = $orderNumber;
    }

    public function getSpeditor(): string
    {
        return $this->speditor;
    }

    public function getWaybillNumber(): string
    {
        return $this->waybillNumber;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function getClientName(): string
    {
        return $this->clientName;
    }

    public function getOrderNumber(): string
    {
        return $this->orderNumber;
    }
}
