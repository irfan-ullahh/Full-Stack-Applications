<main class="w-full bg-white/5 border border-white/10 rounded-lg px-3 py-5 space-y-2">
    @push('title')
        Dashboard
    @endpush
    <div class="flex sm:gap-4 gap-0 mb-4 sm:flex-row flex-col">

        <!-- Card 1: Wallet Balance -->
        <div class="bg-white/5 border border-white/10 p-3 rounded-lg text-white space-y-2 w-full md:mb-0 mb-4">
            <div class="flex justify-between items-start">
                <div class="space-y-3">
                    <p class="text-muted text-xs">Wallet Balance</p>
                    <p class="text-primary text-3xl font-bold">Rs. {{ number_format($balance, 2) }}</p>
                    <p class="text-muted text-xs flex gap-2">
                        <span class="{{ $balancePercentageChange >= 0 ? 'text-green-500' : 'text-red-500' }} flex gap-1">
                            {{ $balancePercentageChange }}%
                            @if ($balancePercentageChange >= 0)
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                </svg>
                            @else
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 17h8m0 0v-8m0 8l-8-8-4 4-6-6"></path>
                                </svg>
                            @endif
                        </span> vs last month
                    </p>
                </div>
                <span class="bg-green-500/10 rounded-xl p-2">
                    <svg class="w-6 h-6 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <g fill="none">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="1.5" d="M6 8h4" />
                            <path stroke="currentColor" stroke-linecap="round" stroke-width="1.5"
                                d="M22 10.5c0-.077 0-.533-.002-.565c-.036-.501-.465-.9-1.005-.933C20.959 9 20.918 9 20.834 9h-2.602C16.446 9 15 10.343 15 12s1.447 3 3.23 3h2.603c.084 0 .125 0 .16-.002c.54-.033.97-.432 1.005-.933c.002-.032.002-.488.002-.565" />
                            <circle cx="18" cy="12" r="1" fill="currentColor" />
                            <path stroke="currentColor" stroke-linecap="round" stroke-width="1.5"
                                d="M13 4c3.771 0 5.657 0 6.828 1.172c.809.808 1.06 1.956 1.137 3.828M10 20h3c3.771 0 5.657 0 6.828-1.172c.809-.808 1.06-1.956 1.137-3.828M9 4c-3.114.01-4.765.108-5.828 1.172C2 6.343 2 8.229 2 12s0 5.657 1.172 6.828c.653.654 1.528.943 2.828 1.07" />
                        </g>
                    </svg>
                </span>
            </div>
            <hr class="border-0 bg-white/10 h-0.5">
            <div>
                <p class="text-muted text-xs">Added this week: <span class="text-green-500">Rs.
                        {{ number_format($weekDeposit, 2) }}</span></p>
            </div>
        </div>

        <!-- Card 2: This Month Spent -->
        <div class="bg-white/5 border border-white/10 p-3 rounded-lg text-white space-y-2 w-full md:mb-0 mb-4">
            <div class="flex justify-between items-start">
                <div class="space-y-3">
                    <p class="text-muted text-xs">This Month Spent</p>
                    <p class="text-primary text-3xl font-bold">Rs. {{ number_format($monthSpent, 2) }}</p>
                    <p class="text-muted text-xs flex gap-2">
                        <span
                            class="{{ $monthSpentPercentageChange >= 0 ? 'text-red-500' : 'text-green-500' }} flex gap-1">
                            {{ $monthSpentPercentageChange }}%
                            @if ($monthSpentPercentageChange >= 0)
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 17h8m0 0v-8m0 8l-8-8-4 4-6-6"></path>
                                </svg>
                            @else
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                </svg>
                            @endif
                        </span> vs last month
                    </p>
                </div>
                <span class="bg-pink-500/10 rounded-xl p-2">
                    <svg class="w-6 h-6 text-pink-500" xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                        viewBox="0 0 24 24">
                        <g fill="none" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.171 12.79h2.5a.485.485 0 0 1 .5.523v9.41a.483.483 0 0 1-.5.522h-2.5" />
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M10.322 10.584L8.4 12.977a1.4 1.4 0 0 1-1.045.523H6.171m0 7.03c2.144 1.625 4.1 2.716 5.363 2.716h6.273c.76 0 1.238-.054 1.568-1.045c.504-2.53.853-5.088 1.046-7.66c0-.522-.523-1.045-1.568-1.045h-5.932m-2.367-1.291L9.006 1.373a.546.546 0 0 1 .54-.623H17.1" />
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m13.839 13.5l-.916-9.159a.5.5 0 0 1 .5-.553h6.9a.5.5 0 0 1 .5.577l-1.38 9.2" />
                            <path d="M16.696 9.37a.375.375 0 0 1 0-.75m0 .75a.375.375 0 1 0 0-.75" />
                        </g>
                    </svg>
                </span>
            </div>
            <hr class="border-0 bg-white/10 h-0.5">
            <p class="text-muted text-xs">Other: <span class="text-yellow-500">Rs.
                    {{ number_format($otherSpentThisMonth, 2) }}</span></p>
        </div>

        <!-- Card 3: Total Transactions -->
        <div class="bg-white/5 border border-white/10 p-3 rounded-lg text-white space-y-2 w-full">
            <div class="flex justify-between items-start">
                <div class="space-y-3">
                    <p class="text-muted text-xs">Total Transactions</p>
                    <p class="text-primary text-3xl font-bold">{{ $totalTransactions }}</p>
                    <p class="text-muted text-xs flex gap-2">
                        <span
                            class="{{ $transactionsPercentageChange >= 0 ? 'text-green-500' : 'text-red-500' }} flex gap-1">
                            {{ $transactionsPercentageChange }}%
                            @if ($transactionsPercentageChange >= 0)
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                </svg>
                            @else
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 17h8m0 0v-8m0 8l-8-8-4 4-6-6"></path>
                                </svg>
                            @endif
                        </span> this month
                    </p>
                </div>
                <span class="bg-yellow-500/10 text-yellow-500 rounded-xl p-2">
                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path fill="currentColor" fill-rule="evenodd"
                            d="M7.099 1.25H16.9c1.017 0 1.717 0 2.306.204a3.8 3.8 0 0 1 2.348 2.412l-.713.234l.713-.234c.196.597.195 1.307.195 2.36v14.148c0 1.466-1.727 2.338-2.864 1.297a.196.196 0 0 0-.271 0l-.484.442c-.928.85-2.334.85-3.262 0a.907.907 0 0 0-1.238 0c-.928.85-2.334.85-3.262 0a.907.907 0 0 0-1.238 0c-.928.85-2.334.85-3.262 0l-.483-.442a.196.196 0 0 0-.272 0c-1.137 1.04-2.864.169-2.864-1.297V6.227c0-1.054 0-1.764.195-2.361a3.8 3.8 0 0 1 2.348-2.412c.59-.205 1.289-.204 2.306-.204m.146 1.5c-1.221 0-1.642.01-1.96.121A2.3 2.3 0 0 0 3.87 4.334c-.111.338-.12.784-.12 2.036v14.004c0 .12.059.192.134.227a.2.2 0 0 0 .11.018a.2.2 0 0 0 .107-.055a1.695 1.695 0 0 1 2.296 0l.483.442a.907.907 0 0 0 1.238 0a2.407 2.407 0 0 1 3.262 0a.907.907 0 0 0 1.238 0a2.407 2.407 0 0 1 3.262 0a.907.907 0 0 0 1.238 0l.483-.442a1.695 1.695 0 0 1 2.296 0c.043.04.08.052.108.055a.2.2 0 0 0 .109-.018c.075-.035.135-.108.135-.227V6.37c0-1.252-.01-1.698-.12-2.037a2.3 2.3 0 0 0-1.416-1.462c-.317-.11-.738-.12-1.959-.12zM6.25 7.5A.75.75 0 0 1 7 6.75h.5a.75.75 0 0 1 0 1.5H7a.75.75 0 0 1-.75-.75m3.5 0a.75.75 0 0 1 .75-.75H17a.75.75 0 0 1 0 1.5h-6.5a.75.75 0 0 1-.75-.75M6.25 11a.75.75 0 0 1 .75-.75h.5a.75.75 0 0 1 0 1.5H7a.75.75 0 0 1-.75-.75m3.5 0a.75.75 0 0 1 .75-.75H17a.75.75 0 0 1 0 1.5h-6.5a.75.75 0 0 1-.75-.75m-3.5 3.5a.75.75 0 0 1 .75-.75h.5a.75.75 0 0 1 0 1.5H7a.75.75 0 0 1-.75-.75m3.5 0a.75.75 0 0 1 .75-.75H17a.75.75 0 0 1 0 1.5h-6.5a.75.75 0 0 1-.75-.75"
                            clip-rule="evenodd" stroke-width="0.5" stroke="currentColor" />
                    </svg>
                </span>
            </div>
            <hr class="border-0 bg-white/10 h-0.5">
            <div>
                <p class="text-muted text-xs">Pending: <span class="text-red-500">{{ $pendingTransactions }}</span>
                </p>
            </div>
        </div>
    </div>
    <div class="bg-white/5 border border-white/10 rounded-lg p-6 space-y-6">
        <div>
            <p class="text-white">Transaction History</p>
            <p class="text-xs text-white/70">View your latest transactions</p>
        </div>

        <hr class="border-0 bg-white/10 h-0.5">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-white border-separate border-spacing-y-6">
                <thead class="text-muted">
                    <tr>
                        <th>ID</th>
                        <th>RECEIVER ACCOUNT</th>
                        <th>RECEIVER REGISTRATION</th>
                        <th>DATE & TIME</th>
                        <th>TYPE</th>
                        <th>AMOUNT</th>
                        <th>STATUS</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($transactions as $transaction)
                        <tr>
                            <td class="py-3 pr-4">{{ $transaction->id }}</td>
                            <td class="py-3 pr-4">{{ $transaction->receiver->full_name }}</td>
                            <td class="py-3 pr-4">{{ $transaction->receiver->registration_number }}</td>
                            <td class="py-3 pr-4">{{ $transaction->created_at->format('F j, Y g:i A') }}</td>
                            <td class="py-3 pr-4">{{ $transaction->type }}</td>
                            <td class="py-3 pr-4 text-green-400">{{ $transaction->amount }}</td>
                            <td class="py-3 pr-4">
                                @if ($transaction->status === 'success')
                                    <span
                                        class="bg-green-500/10 text-green-400 px-2 py-0.5 rounded-full ">Success</span>
                                @elseif($transaction->status === 'pending')
                                    <span
                                        class="bg-yellow-500/10 text-yellow-400 px-2 py-0.5 rounded-full ">Pending</span>
                                @else
                                    <span class="bg-red-500/10 text-red-400 px-2 py-0.5 rounded-full ">Rejcted</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">
                                <div class="text-center py-6">
                                     <svg class="text-zinc-400 mx-auto mb-3" width="100" xmlns="http://www.w3.org/2000/svg"
                                 viewBox="0 0 24 24">
                                 <path d="M0 0h24v24H0z" fill="none" />
                                 <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-width="1">
                                     <path
                                         d="M16.093 13C17.23 12.098 18 10.85 18 9.47C18 6.72 14.945 2 12 2C9.054 2 6 6.72 6 9.47c0 1.38.77 2.628 1.908 3.53" />
                                     <path stroke-linejoin="round"
                                         d="M13.5 14c-.484 4 .4 5.714 3.5 8m-6.5-8c.484 4-.4 5.714-3.5 8m6.5-8c1 2 3.58 4.5 5.547 4.5c1.969 0 2.953-1.231 2.953-2.75S20.898 13 19.54 13m-9.04 1c-1 2-3.58 4.5-5.548 4.5S2 17.269 2 15.75S3.102 13 4.46 13" />
                                     <path
                                         d="M10.125 10H10m.25 0a.25.25 0 1 1-.5 0a.25.25 0 0 1 .5 0Zm3.875 0H14m.25 0a.25.25 0 1 1-.5 0a.25.25 0 0 1 .5 0Z" />
                                 </g>
                             </svg>
                                    <p class="text-zinc-400 text-sm">No Records Found</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>
    </div>
</main>
