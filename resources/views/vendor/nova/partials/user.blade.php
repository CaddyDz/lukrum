<dropdown-trigger class="h-9 flex items-center">
	<img src="https://secure.gravatar.com/avatar/{{ md5(\Illuminate\Support\Str::lower($user->email)) }}?size=512" class="rounded-full w-8 h-8 mr-3" />

	<span class="text-90">
		{{ $user->name }}
	</span>
</dropdown-trigger>

<dropdown-menu slot="menu" width="200" direction="rtl">
	<ul class="list-reset">
		<li>
			<a href="/resources/templates" class="block no-underline text-90 hover:bg-30 p-3">
				@lang('Templates')
			</a>
		</li>
		<li>
			<a href="/resources/emails" class="block no-underline text-90 hover:bg-30 p-3">
				@lang('Emails')
			</a>
		</li>
		<li>
			<a href="/resources/users" class="block no-underline text-90 hover:bg-30 p-3">
				@lang('Users')
			</a>
		</li>
		<li>
			<a href="{{ route('nova.logout') }}" class="block no-underline text-90 hover:bg-30 p-3">
				@lang('Logout')
			</a>
		</li>
	</ul>
</dropdown-menu>
