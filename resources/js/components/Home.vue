<template>
    <div class="min-h-full">
        <main>
            <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
                <div class="px-4 py-6 sm:px-0">
                    <div
                        class="
                            border-4 border-dashed border-gray-200
                            rounded-lg
                            h-96
                        "
                    >
                        <div
                            class="
                                max-w-7xl
                                mx-auto
                                py-6
                                px-4
                                sm:px-6
                                lg:px-8
                                text-center
                                shadow
                            "
                        >
                            <h1 class="text-3xl font-bold text-gray-900">
                                Insert the URL below you would like to be
                                shortened
                            </h1>
                        </div>
                        <div
                            class="
                                p-8
                                mt-12
                                flex
                                items-center
                                justify-center
                                bg-white
                            "
                        >
                            <form
                                v-on:submit.prevent="shorten"
                                class="w-full max-w-xl mx-auto"
                            >
                                <div class="relative rounded-md shadow-lg">
                                    <input
                                        v-model="form.long_url"
                                        type="text"
                                        name="price"
                                        id="price"
                                        class="
                                            focus:ring-indigo-500
                                            focus:border-indigo-500
                                            block
                                            w-full
                                            pl-5
                                            pr-24
                                            text-lg
                                            border-gray-300
                                            rounded-md
                                        "
                                        placeholder="Long URL"
                                    />
                                    <div
                                        class="
                                            absolute
                                            inset-y-0
                                            right-0
                                            flex
                                            items-center
                                        "
                                    >
                                        <button
                                            type="submit"
                                            class="
                                                inline-flex
                                                justify-center
                                                py-2
                                                px-4
                                                border border-transparent
                                                shadow-sm
                                                text-lg
                                                font-medium
                                                rounded-r-md
                                                text-white
                                                bg-indigo-600
                                                hover:bg-indigo-700
                                                focus:outline-none
                                                focus:ring-2
                                                focus:ring-offset-2
                                                focus:ring-indigo-500
                                            "
                                        >
                                            Shorten
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="block text-center">
                            <loading v-if="loading"></loading>
                            <p
                                v-for="(error, index) in errors"
                                :key="index"
                                class="text-sm text-red-500 animate-bounce"
                            >
                                {{ error }}
                            </p>
                            <p
                                v-if="message"
                                class="text-sm text-teal-500 animate-bounce"
                            >
                                {{ message }}
                            </p>
                            <div
                                v-if="urlRecord"
                                class="w-full max-w-xl mx-auto mt-8"
                            >
                                <div
                                    class="
                                        shadow
                                        border
                                        bg-gray-700
                                        text-white
                                        rounded-md
                                        relative
                                        block
                                        w-full
                                        pl-5
                                        pr-24
                                        py-2
                                        text-left
                                    "
                                >
                                    <span class="text-md">{{
                                        urlRecord.short_url
                                    }}</span>
                                    <div
                                        class="
                                            absolute
                                            inset-y-0
                                            right-1
                                            flex
                                            items-center
                                            space-x-1
                                        "
                                    >
                                        <a
                                            target="_blank"
                                            :href="urlRecord.short_url"
                                            class="
                                                inline-flex
                                                py-1
                                                px-1
                                                border border-transparent
                                                shadow-sm
                                                text-sm
                                                rounded-md
                                                text-white
                                                bg-teal-600
                                                hover:bg-teal-700
                                                focus:outline-none
                                                focus:ring-2
                                                focus:ring-offset-2
                                                focus:ring-teal-500
                                            "
                                        >
                                            <ExternalLinkIcon
                                                class="h-5 w-5 block"
                                            />
                                        </a>
                                        <button
                                            v-on:click.prevent="copyShortUrl"
                                            v-tooltip="{
                                                content:
                                                    '<svg xmlns=\'http://www.w3.org/2000/svg\' class=\'h-6 w-6 inline\' fill=\'none\' viewBox=\'0 0 24 24\' stroke=\'currentColor\' stroke-width=\'2\'><path stroke-linecap=\'round\' stroke-linejoin=\'round\' d=\'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4\' /></svg> Copied !',
                                                shown: shortUrlCopied,
                                                html: true,
                                                distance: 10,
                                                triggers: [],
                                            }"
                                            class="
                                                inline-flex
                                                py-1
                                                px-1
                                                border border-transparent
                                                shadow-sm
                                                text-sm
                                                rounded-md
                                                text-white
                                                bg-indigo-600
                                                hover:bg-indigo-700
                                                focus:outline-none
                                                focus:ring-2
                                                focus:ring-offset-2
                                                focus:ring-indigo-500
                                            "
                                        >
                                            <DocumentDuplicateIcon
                                                class="h-5 w-5 block"
                                            />
                                        </button>
                                        <button
                                            v-on:click.prevent="clearShortened"
                                            class="
                                                inline-flex
                                                py-1
                                                px-1
                                                border border-transparent
                                                shadow-sm
                                                text-sm
                                                rounded-md
                                                text-white
                                                bg-rose-600
                                                hover:bg-rose-700
                                                focus:outline-none
                                                focus:ring-2
                                                focus:ring-offset-2
                                                focus:ring-rose-500
                                            "
                                        >
                                            <XIcon class="h-5 w-5 block" />
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /End replace -->
            </div>
        </main>
    </div>
</template>


<script>
import { reactive, ref } from "vue";
import {
    ExternalLinkIcon,
    DocumentDuplicateIcon,
    XIcon,
    ClipboardCheckIcon,
} from "@heroicons/vue/outline";
import useClipboard from "vue-clipboard3";
export default {
    components: {
        ExternalLinkIcon,
        DocumentDuplicateIcon,
        XIcon,
        ClipboardCheckIcon,
    },
    setup() {
        const loading = ref(false);
        const urlRecord = ref(null);
        const form = reactive({
            long_url: "",
        });
        const errors = ref([]);
        const message = ref("");
        const { toClipboard } = useClipboard();
        const shortUrlCopied = ref(false);

        const shorten = async () => {
            errors.value = [];
            urlRecord.value = null;
            loading.value = true;
            try {
                let { data: responseData } = await axios.post(
                    "/api/urls/shorten",
                    form
                );
                urlRecord.value = responseData.data;
                message.value = "Short URL generated.";
                setTimeout(() => {
                    message.value = "";
                }, 5000);
            } catch (error) {
                if (error.response.status === 422) {
                    for (let key in error.response.data.errors) {
                        errors.value.push(error.response.data.errors[key][0]);
                    }
                    setTimeout(() => {
                        errors.value = [];
                    }, 5000);
                }
            }
            loading.value = false;
        };

        const clearShortened = () => {
            errors.value = [];
            message.value = "";
            urlRecord.value = null;
            form.long_url = "";
        };

        const copyShortUrl = async () => {
            try {
                await toClipboard(urlRecord.value.short_url);
                shortUrlCopied.value = true;
                setTimeout(() => {
                    shortUrlCopied.value = false;
                }, 1500);
            } catch (e) {
                console.error(e);
            }
        };

        return {
            urlRecord,
            form,
            message,
            errors,
            loading,
            shorten,
            clearShortened,
            copyShortUrl,
            shortUrlCopied,
        };
    },
};
</script>
