@php
    use Statamic\Facades\Form;

    $entries = \Statamic\Facades\Collection::find('locations')->queryEntries()->where('published', true)->get();

    $locations = $entries->map(function ($entry) {
        return $entry
            ->toAugmentedCollection(['id', 'title', 'location_address', 'location_address_url', 'location_open_hours', 'location_coming', 'location_menu_link'])
            ->withShallowNesting()
            ->toArray();
    });

@endphp

<section>
    <l-p-List :has-panel="true">
        <template #items="{showMore, selectItem}">
            <ul
                class="grid grid-cols-1 gap-x-5 gap-y-7 md:gap-y-10 md:grid-cols-2 xl:grid-cols-3 xl:justify-items-stretch"
            >
                @foreach($locations as $loc)
                    <li
                        class="w-full flex flex-col col-span-1 max-w-sm group rounded-[5px] p-7 border border-black"
                    >
                        <div>
                            <h1
                                class="font-title font-medium text-lg md:text-xl leading-snug uppercase"
                            >
                                {{ $loc['title'] }}
                            </h1>
                            <button
                                class="flex leading-none underline bg-transparent mt-2.5"
                                @click="{{ 'showMore('.json_encode($loc).')' }}"
                            >
                                <span>Show more</span>
                            </button>
                        </div>
                    </li>
                @endforeach
            </ul>
        </template>

        <template #panel="{dataPanel, panelSelectItem}">
            <div
                class="h-full bg-white border-l border-black pt-10 pb-36 px-5 mx:px-10 xl:pl-18 xl:pr-25"
            >
                <div
                    class="md:w-3/4 xl:w-full flex flex-col md:mx-auto"
                    v-if="dataPanel"
                >
                    <h2
                        class="font-title font-medium text-4xl leading-custom" v-text="dataPanel.title"
                    >
                    </h2>
                    <a :href="dataPanel.location_address_url" target="_blank" class="leading-none mt-5" v-text="dataPanel.location_address">
                    </a>
                    <div class="mt-10" v-if="dataPanel.location_open_hours.length > 0">
                        <template
                            v-for="(operation, index) in dataPanel.location_open_hours"
                        >
                            <div
                                :class="[
											index != dataPanel.location_open_hours.length - 1
												? 'pb-0.5'
												: '',
										]"
                            >
                                <span
                                    class="text-lg md:text-xl uppercase" v-text="operation.open_day +':'"
                                ></span>
                                <span
                                    class="text-lg md:text-xl font-light ml-2"
                                    v-html="operation.open_hour"
                                ></span>
                            </div>
                        </template>
                    </div>
                    <div class="mt-10" v-if="dataPanel.location_menu_link">
                        <a :href="'/career#'+dataPanel.location_menu_link" class="font-bold text-xl leading-none  uppercase underline">
                            View Menu
                        </a>
                    </div>
                </div>
            </div>
        </template>
    </l-p-list>
</section>
