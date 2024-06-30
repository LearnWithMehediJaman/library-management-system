<template>
    <AppSectionHeader title="Authors" :bread-crumb="breadCrumb">
    </AppSectionHeader>

    <AppCard class="w-full md:w-3/4 xl:w-1/2">
        <template #title> {{ title }} </template>
        <template #content>
            <AppFormErrors class="mb-4" />
            <form>
                <div>
                    <AppLabel for="name">{{ __('Name') }}</AppLabel>
                    <AppInputText
                        id="name"
                        v-model="form.name"
                        type="text"
                        :class="{
                            'input-error': errorsFields.includes('name')
                        }"
                    />
                </div>

                <div>
                    <AppLabel for="country">{{ __('Country') }}</AppLabel>
                    <AppInputText
                        id="country"
                        v-model="form.country"
                        type="text"
                        :class="{
                            'input-error': errorsFields.includes('country')
                        }"
                    />
                </div>
            </form>
        </template>
        <template #footer>
            <AppButton class="btn btn-primary" @click="submitForm">
                {{ __('Save') }}
            </AppButton>
        </template>
    </AppCard>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3'

import useTitle from '@/Composables/useTitle'
import useFormContext from '@/Composables/useFormContext'
import useFormErrors from '@/Composables/useFormErrors'

const props = defineProps({
    author: {
        type: Object,
        default: null
    }
})

const breadCrumb = [
    { label: 'Home', href: route('dashboard.index') },
    { label: 'Authors', href: route('author.index') },
    { label: 'Author', last: true }
]

const { title } = useTitle('Author')

const form = useForm({
    name: props.author ? props.author.name : '',
    country: props.author ? props.author.country : ''
})

const { isCreate } = useFormContext()

const submitForm = () => {
    if (isCreate.value) {
        form.post(route('author.store'))
    } else {
        form.put(route('author.update', props.author.id))
    }
}

const { errorsFields } = useFormErrors()
</script>
