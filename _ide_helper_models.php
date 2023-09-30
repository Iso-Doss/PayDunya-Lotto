<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Country
 *
 * @property int $id
 * @property string $name
 * @property string $code
 * @property string $phone_code
 * @property string|null $activated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Country newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Country newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Country onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Country query()
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereActivatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country wherePhoneCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Country withoutTrashed()
 * @mixin \Eloquent
 */
	class IdeHelperCountry {}
}

namespace App\Models{
/**
 * App\Models\Lottery
 *
 * @property int $id
 * @property string $name
 * @property string $date
 * @property int $jackpot
 * @property string|null $numbers_drawn
 * @property string|null $description
 * @property string|null $short_description
 * @property string|null $image
 * @property string|null $video
 * @property int|null $status_id
 * @property string|null $activated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Status|null $status
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Status> $statuses
 * @property-read int|null $statuses_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Lottery newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Lottery newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Lottery onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Lottery query()
 * @method static \Illuminate\Database\Eloquent\Builder|Lottery whereActivatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lottery whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lottery whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lottery whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lottery whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lottery whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lottery whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lottery whereJackpot($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lottery whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lottery whereNumbersDrawn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lottery whereShortDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lottery whereStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lottery whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lottery whereVideo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lottery withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Lottery withoutTrashed()
 * @mixin \Eloquent
 */
	class IdeHelperLottery {}
}

namespace App\Models{
/**
 * App\Models\LotteryStatus
 *
 * @property-read \App\Models\Lottery|null $lottery
 * @property-read \App\Models\Status $status
 * @method static \Illuminate\Database\Eloquent\Builder|LotteryStatus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LotteryStatus newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LotteryStatus onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|LotteryStatus query()
 * @method static \Illuminate\Database\Eloquent\Builder|LotteryStatus withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|LotteryStatus withoutTrashed()
 * @mixin \Eloquent
 */
	class IdeHelperLotteryStatus {}
}

namespace App\Models{
/**
 * App\Models\LotteryUser
 *
 * @property int $user_id
 * @property int $lottery_id
 * @property int|null $status_id
 * @property int|null $amount
 * @property string|null $details
 * @property string|null $activated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Lottery $lottery
 * @property-read \App\Models\Status|null $status
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|LotteryUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LotteryUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LotteryUser onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|LotteryUser query()
 * @method static \Illuminate\Database\Eloquent\Builder|LotteryUser whereActivatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LotteryUser whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LotteryUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LotteryUser whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LotteryUser whereDetails($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LotteryUser whereLotteryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LotteryUser whereStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LotteryUser whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LotteryUser whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LotteryUser withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|LotteryUser withoutTrashed()
 * @mixin \Eloquent
 */
	class IdeHelperLotteryUser {}
}

namespace App\Models{
/**
 * App\Models\PasswordResetTokens
 *
 * @property string $email
 * @property string|null $new_email
 * @property string $profile
 * @property string $type
 * @property string $token
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|PasswordResetTokens newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PasswordResetTokens newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PasswordResetTokens query()
 * @method static \Illuminate\Database\Eloquent\Builder|PasswordResetTokens whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PasswordResetTokens whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PasswordResetTokens whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PasswordResetTokens whereNewEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PasswordResetTokens whereProfile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PasswordResetTokens whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PasswordResetTokens whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PasswordResetTokens whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class IdeHelperPasswordResetTokens {}
}

namespace App\Models{
/**
 * App\Models\Status
 *
 * @property int $id
 * @property string $name
 * @property string $code
 * @property string|null $description
 * @property string|null $message
 * @property string|null $entity
 * @property int $priority_level
 * @property string|null $icon
 * @property string|null $color
 * @property string|null $activated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Lottery> $lotteries
 * @property-read int|null $lotteries_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Transaction> $transactions
 * @property-read int|null $transactions_count
 * @method static \Illuminate\Database\Eloquent\Builder|Status newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Status newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Status onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Status query()
 * @method static \Illuminate\Database\Eloquent\Builder|Status whereActivatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Status whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Status whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Status whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Status whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Status whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Status whereEntity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Status whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Status whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Status whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Status whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Status wherePriorityLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Status whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Status withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Status withoutTrashed()
 * @mixin \Eloquent
 */
	class IdeHelperStatus {}
}

namespace App\Models{
/**
 * App\Models\Ticket
 *
 * @property int $id
 * @property string $name
 * @property int $price
 * @property string|null $short_description
 * @property string|null $description
 * @property string|null $image
 * @property string|null $activated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Transaction> $transactions
 * @property-read int|null $transactions_count
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket query()
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereActivatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereShortDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket withoutTrashed()
 * @mixin \Eloquent
 */
	class IdeHelperTicket {}
}

namespace App\Models{
/**
 * App\Models\Transaction
 *
 * @property int $user_id
 * @property int $lottery_id
 * @property int $transaction_type_id
 * @property int|null $ticket_id
 * @property int|null $status_id
 * @property int|null $amount
 * @property string|null $details
 * @property string|null $activated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Lottery $lottery
 * @property-read \App\Models\Status|null $status
 * @property-read \App\Models\Ticket|null $ticket
 * @property-read \App\Models\TransactionType $transactionType
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction query()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereActivatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereDetails($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereLotteryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereTicketId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereTransactionTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction withoutTrashed()
 * @mixin \Eloquent
 */
	class IdeHelperTransaction {}
}

namespace App\Models{
/**
 * App\Models\TransactionType
 *
 * @property int $id
 * @property string $name
 * @property string $code
 * @property string|null $description
 * @property string|null $icon
 * @property string|null $color
 * @property string|null $activated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Transaction> $transactions
 * @property-read int|null $transactions_count
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionType onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionType query()
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionType whereActivatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionType whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionType whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionType whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionType whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionType whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionType whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionType withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionType withoutTrashed()
 * @mixin \Eloquent
 */
	class IdeHelperTransactionType {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $profile
 * @property string $email
 * @property string $password
 * @property string|null $name
 * @property string|null $user_type
 * @property string|null $first_name
 * @property string|null $last_name
 * @property string|null $user_name
 * @property string|null $registration_number
 * @property string|null $phone_number
 * @property int|null $ifu
 * @property string|null $avatar
 * @property string|null $gender
 * @property string|null $birthday
 * @property string|null $city
 * @property string|null $address
 * @property string|null $website
 * @property int|null $has_default_password
 * @property string|null $activated_at
 * @property string|null $verified_at
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property \Illuminate\Support\Carbon|null $phone_number_verified_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $country_id
 * @property-read \App\Models\Country|null $country
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereActivatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereBirthday($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCountryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereHasDefaultPassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIfu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhoneNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhoneNumberVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereProfile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRegistrationNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUserName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUserType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereWebsite($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|User withoutTrashed()
 * @mixin \Eloquent
 */
	class IdeHelperUser {}
}

