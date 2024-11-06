<div class="h-screen w-full max-w-4xl mx-auto flex flex-col" x-cloak>
    <div class="space-y-4 pt-16 pb-20 px-1 sm:px-4">
        <div class="avatar w-full">
            <div class="w-24 rounded-full mx-auto">
                <img src="{{ asset('logo.png') }}" />
            </div>
        </div>
        <p class="font-semibold">Leconfe v{{ app()->getCodeVersion() }}</p>
        <form wire:submit='upgrade'>
            <div class="card bg-white text-sm">
                <div class="card-body space-y-6 p-4 sm:p-8">
                    @error('upgrade')
                        <div class="alert alert-error">
                            <x-heroicon-o-exclamation-circle class="stroke-current shrink-0 h-6 w-6" />
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                    <div class="overflow-x-auto">
                        <table class="table">
                          <tbody>
                            <tr >
                              <th class="w-36">Installed Version</th>
                              <td class="w-4">:</td>
                              <td>v{{ $installedVersion }}</td>
                            </tr>
                            <tr>
                              <th class="w-36">Code Version</th>
                              <td calss="w-4">:</td>
                              <td>v{{ $codeVersion }}</td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    <div class="space-y-2">
                        <p class="introduction">
                            Thank you for downloading the <b>Leconfe</b>, a project by <a class="link link-primary link-hover"
                            target="_blank" href="https://openjournaltheme.com">Open Journal Theme</a>. Before proceeding with the upgrade, please ensure you have thoroughly read the <a class="link link-primary link-hover" target="_blank" href="https://leconfe.com/docs/upgrade/">Upgrade documentation</a>.
                        </p>
                        
                        <p>
                            You must <b>BACKUP</b> your entire Leconfe installation directory before initiating the upgrade. This includes all files, databases, and configurations. Failure to do so may result in data loss or corruption.
                        </p>
                        <p>
                            For additional information about Leconfe, please visit the <a class="link link-primary link-hover" target="_blank" href="https://leconfe.com">Leconfe website</a>. If you encounter any issues or have technical support inquiries, please refer to the <a class="link link-primary link-hover" target="_blank" href="https://forum.leconfe.com">support forum</a>. The support forum is the preferred method of contact for bug reports and technical support. Alternatively, you can reach out to our support team via email at <a class="link link-primary link-hover" href="mailto:support@leconfe.com">support@leconfe.com</a>.
                        </p>
                        <p>
                            If you have any custom modifications or third-party integrations, please verify their compatibility with the new version before proceeding. Incompatible modifications or integrations may cause unexpected issues during or after the upgrade.
                        </p>
                    </div>
                    <div class="flex justify-between mt-16">
                        <button class="btn btn-primary btn-outline btn-sm ml-auto" wire:loading.attr="disabled"
                            type="submit">
                            <span class="loading loading-spinner loading-xs" wire:loading wire:target='upgrade'></span>
                            Upgrade
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
