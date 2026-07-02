 <main class="w-full bg-white/5 border border-white/10 rounded-lg px-3 p-5 min-h-143 space-y-5 overflow-x-auto">
     @push('title')
         Transaction History
     @endpush
     <div class="flex justify-between items-center sm:flex-row flex-col gap-4">
         <div class="text-white">
             <p class="text-primary text-2xl font-bold">Transfer Money</p>
             <p class="text-muted text-xs text-white">Send funds to another student</p>
         </div>
         <div class="flex gap-3">
             <div class="bg-white/5 border border-white/10 rounded-lg p-2">
                 <p class="text-white text-xs">Total Deposits</p>
                 <p class="text-green-400 font-bold text-sm">+Rs. {{ number_format($totalDeposits, 2) }}</p>
             </div>
             <div class="bg-white/5 border border-white/10 rounded-lg p-2">
                 <p class="text-white text-xs">Total Transfers</p>
                 <p class="text-red-400 font-bold text-sm">-Rs. {{ number_format($totalTransfers, 2) }}</p>
             </div>
             <div class="bg-white/5 border border-white/10 rounded-lg p-2">
                 <p class="text-white text-xs">Total Transactions</p>
                 <p class="text-white font-bold text-sm">{{ $totalTransactions }}</p>
             </div>
         </div>
     </div>
     <hr class="border-0 bg-white/10 h-0.5">
     <table class="w-[stretch] text-left text-sm text-white border-separate border-spacing-y-6 mx-5">
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
                             <span class="bg-green-500/10 text-green-400 px-2 py-0.5 rounded-full ">Success</span>
                         @elseif($transaction->status === 'pending')
                             <span class="bg-yellow-500/10 text-yellow-400 px-2 py-0.5 rounded-full ">Pending</span>
                         @else
                             <span class="bg-red-500/10 text-red-400 px-2 py-0.5 rounded-full ">Rejcted</span>
                         @endif
                     </td>
                 </tr>
             @empty
                 <tr>
                     <td colspan="7">
                         <div class="text-center py-6 mt-15">
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
 </main>
