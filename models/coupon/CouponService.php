<?php

declare(strict_types=1);

namespace app\models\coupon;

class CouponService
{
    private CouponRepository $couponRepository;

    public function __construct(CouponRepository $couponRepository)
    {
        $this->couponRepository = $couponRepository;
    }

    public function create(CouponForm $form): Coupon
    {
        $coupon = Coupon::create(
            $form->name,
            $form->description,
            $form->type,
            $form->code,
            $form->shopId,
            $form->startAt,
            $form->endAt,
            $form->url,
            $form->status,
        );
        $this->couponRepository->save($coupon);
        return $coupon;
    }

    public function edit($id, CouponForm $form): Coupon
    {
        $coupon = $this->couponRepository->getById($id);
        $coupon->edit(
            $form->name,
            $form->description,
            $form->type,
            $form->code,
            $form->shopId,
            $form->startAt,
            $form->endAt,
            $form->url,
            $form->status,
        );
        $this->couponRepository->save($coupon);
        return $coupon;
    }

    public function remove($id): void
    {
        $this->couponRepository->remove($this->couponRepository->getById($id));
    }
}