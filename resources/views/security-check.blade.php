@php($t = fn (string $key, array $replace = []) => __('security-check::messages.'.$key, $replace, $locale))

<div class="wt" lang="{{ $locale }}" x-data="{
        step: 0,
        timer: null,
        start() { this.step = 0; clearInterval(this.timer); this.timer = setInterval(() => this.step = Math.min(this.step + 1, 2), 1200) },
        again() { this.$refs.form.scrollIntoView({ behavior: 'smooth', block: 'center' }); this.$refs.url.focus({ preventScroll: true }); this.$refs.url.select() },
    }" @wt-again="again()">
    <form class="wt-tool" wire:submit="analyze" @submit="start()" x-ref="form" novalidate>
        <div class="wt-row">
            <div @class(['wt-field', 'wt-field-err' => $errors->has('url')])>
                <input id="wt-url" type="text" inputmode="url" autocomplete="url" placeholder=" "
                       wire:model="url" x-ref="url">
                <label for="wt-url">{{ $t('form.label') }}</label>
            </div>
            <button type="submit" class="wt-go" wire:loading.attr="disabled" wire:target="analyze">
                <span wire:loading.remove wire:target="analyze">{{ $t('form.button') }}</span>
                <span wire:loading wire:target="analyze" class="wt-spin" aria-hidden="true"></span>
            </button>
        </div>
        <p class="wt-hint">{{ $t('form.hint', ['count' => config('security-check.rate_limit.per_hour')]) }}</p>
        @error('url')<p class="wt-error">{{ $message }}</p>@enderror
        @if ($error)
            <p class="wt-error" role="alert">{{ $error }}</p>
        @endif
    </form>

    {{-- Lines light up on a timer while one request runs; the server does not report its steps --}}
    <div class="wt-log" wire:loading.block wire:target="analyze" aria-hidden="true">
        @foreach (['certificate', 'headers', 'checks'] as $i => $line)
            <p :class="{ 'wt-run': step === {{ $i }}, 'wt-done': step > {{ $i }} }">{{ $t('loading.'.$line) }}</p>
        @endforeach
    </div>

    @if ($report)
        <div wire:loading.remove wire:target="analyze" aria-live="polite">
            @php($certificate = $report['certificate'])
            <section class="sc-cert" aria-labelledby="sc-cert-title">
                <h3 id="sc-cert-title">{{ $t('certificate.title') }}</h3>
                @if ($certificate)
                    @php($expires = \Illuminate\Support\Carbon::parse($certificate['validTo']))
                    <dl class="sc-facts">
                        <div><dt>{{ $t('certificate.issuer') }}</dt><dd>{{ $certificate['issuer'] ?: '—' }}</dd></div>
                        <div><dt>{{ $t('certificate.valid_to') }}</dt>
                            <dd>{{ $expires->locale($locale)->isoFormat('LL') }}
                                <small>{{ $t('certificate.days_left', ['days' => (int) floor(now()->diffInDays($expires, false))]) }}</small></dd></div>
                        <div><dt>{{ $t('certificate.protocol') }}</dt><dd>{{ $certificate['protocol'] ?: '—' }}</dd></div>
                        <div><dt>{{ $t('certificate.names') }}</dt><dd>{{ implode(', ', array_slice($certificate['names'], 0, 4)) }}{{ count($certificate['names']) > 4 ? ' …' : '' }}</dd></div>
                    </dl>
                @else
                    <p class="sc-none">{{ $t('certificate.none') }}</p>
                @endif
            </section>

            @include('web-tools-core::checklist-report', ['report' => $report, 'tool' => 'security-check', 'locale' => $locale])
        </div>
    @endif
</div>
