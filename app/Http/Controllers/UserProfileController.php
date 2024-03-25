<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddAddressRequest;
use App\Http\Requests\AddPhoneRequest;
use App\Http\Requests\UpdateAvatarRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Interfaces\Services\UserProfileServiceInterface;
use App\Interfaces\Services\UserServiceInterface;
use App\Models\Address;
use App\Models\Phone;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;

class UserProfileController extends Controller
{
    private UserProfileServiceInterface $userProfileService;
    private UserServiceInterface $userService;

    public function __construct(UserProfileServiceInterface $userProfileService, UserServiceInterface $userService)
    {
        $this->userProfileService = $userProfileService;
        $this->userService = $userService;
    }

    public function showUserProfile()
    {
        try {
            $profile = $this->userProfileService->getAuthenticatedUserProfile();
            return view('front.profile', compact('profile'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            $this->userService->logout();
            abort(404);
        }
    }

    public function showEditUserProfile()
    {
        try {
            $profile = $this->userProfileService->getAuthenticatedUserProfile();
            return view('front.profile-edit', compact('profile'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            $this->userService->logout();
            abort(404);
        }
    }

    public function updateAvatar(UpdateAvatarRequest $request)
    {
        try {
            $imageFile = $request->file('avatar');
            if ($this->userProfileService->updateAvatar($imageFile)->avatar !== null) {
                return response()->json([
                    'success' => true,
                    'message' => 'Avatar updated successfully.',
                    'image' => 'data:image/jpeg;base64,' . base64_encode($this->userProfileService->updateAvatar($imageFile)->avatar)
                ]);
            }

            return response()->json(['success' => false, 'error' => "Ошибка"], 400);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['success' => false, 'error' => $e->getMessage()], 400);
        }
    }

    public function updateProfile(UpdateProfileRequest $request)
    {
        $userProfile = $this->userProfileService->getAuthenticatedUserProfile();
        try {
            $profileData = $request->validated();

            $userProfile->update([
                'name' => $profileData['fullname'],
                'city' => $profileData['city'] ?? null,
                'passport_data' => $profileData['passport'] ?? null,
                'email' => $profileData['email'] ?? null,
            ]);

            return redirect()->back()->with('success', 'Profile updated successfully.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'There was an error updating the profile.');
        }
    }

    public function addPhone(AddPhoneRequest $request)
    {
        $validated = $request->validated();
        $userProfile = $this->userProfileService->getAuthenticatedUserProfile();

        try {
            $phone = new Phone();
            $phone->user_profile_id = $userProfile->id;
            $phone->number = $validated['phone'];
            $phone->is_active = true;
            $phone->save();

            return response()->json(['success' => true, 'message' => 'Телефон успешно добавлен.']);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['success' => false, 'error' => 'Ошибка при добавлении телефона.']);
        }
    }

    public function addAddress(AddAddressRequest $request)
    {
        $validated = $request->validated();
        $userProfile = $this->userProfileService->getAuthenticatedUserProfile();

        try {
            $address = new Address();
            $address->user_profile_id = $userProfile->id;
            $address->country = $validated['delivery-country'];
            $address->city = $validated['delivery-city'];
            $address->street = $validated['delivery-street'];
            $address->building = $validated['delivery-building'];
            $address->apartment = $validated['delivery-apartment'] ?? '';
            $address->save();

            return response()->json(['success' => true, 'message' => 'Адрес успешно добавлен.']);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['success' => false, 'error' => 'Ошибка при добавлении адреса.']);
        }
    }

    public function updatePhone(AddPhoneRequest $request, $phoneId)
    {
        try {
            $phone = Phone::findOrFail($phoneId);
            $phone->number = $request->input('phone');
            $phone->is_active = true;
            $phone->save();

            return response()->json(['success' => true, 'message' => 'Телефон успешно обновлен.']);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['success' => false, 'error' => 'Ошибка при обновлении телефона.']);
        }
    }

    public function deletePhone($phoneId)
    {
        try {
            $phone = Phone::findOrFail($phoneId);
            $phone->delete();

            return response()->json(['success' => true, 'message' => 'Телефон успешно удален.']);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['success' => false, 'error' => 'Ошибка при удалении телефона.']);
        }
    }

    public function editAddress($addressId)
    {
        try {
            $address = Address::findOrFail($addressId);
            return response()->json($address);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => 'Адрес не найден.'], 404);
        }
    }

    public function updateAddress(AddAddressRequest $request, $addressId)
    {
        try {
            $address = Address::findOrFail($addressId);
            $address->country = $request->input('delivery-country');
            $address->city = $request->input('delivery-city');
            $address->street = $request->input('delivery-street');
            $address->building = $request->input('delivery-building');
            $address->apartment = $request->input('delivery-apartment');
            $address->save();

            return response()->json(['success' => true, 'message' => 'Адрес успешно обновлен.']);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['success' => false, 'error' => 'Ошибка при обновлении адреса.']);
        }
    }

    public function deleteAddress($addressId)
    {
        try {
            $address = Address::findOrFail($addressId);
            $address->delete();

            return response()->json(['success' => true, 'message' => 'Адрес успешно удален.']);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['success' => false, 'error' => 'Ошибка при удалении адреса.']);
        }
    }


}
