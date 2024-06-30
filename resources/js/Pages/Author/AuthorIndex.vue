<template>
    <AppSectionHeader title="Authors" :bread-crumb="breadCrumb">
        <template #right>
            <AppButton
                class="btn btn-primary"
                @click="$inertia.visit(route('author.create'))"
            >
                Create Author
            </AppButton>
        </template>
    </AppSectionHeader>

    <AppDataSearch
        v-if="authors.data.length || route().params.searchTerm"
        :url="route('author.index')"
        fields-to-search="id"
    ></AppDataSearch>

    <AppDataTable v-if="authors.data.length" :headers="headers">
        <template #TableBody>
            <tbody>
                <AppDataTableRow v-for="item in authors.data" :key="item.id">
                    <AppDataTableData>
                        {{ item.id }}
                    </AppDataTableData>

                    <AppDataTableData>
                        {{ item.name }}
                    </AppDataTableData>

                    <AppDataTableData>
                        {{ item.country }}
                    </AppDataTableData>

                    <AppDataTableData>
                        <!-- edit author -->
                        <AppTooltip text="Edit Author" class="mr-2">
                            <AppButton
                                class="btn btn-icon btn-primary"
                                @click="
                                    $inertia.visit(
                                        route('author.edit', item.id)
                                    )
                                "
                            >
                                <i class="ri-edit-line"></i>
                            </AppButton>
                        </AppTooltip>

                        <!-- delete author -->
                        <AppTooltip text="Delete Author">
                            <AppButton
                                class="btn btn-icon btn-destructive"
                                @click="
                                    confirmDelete(
                                        route('author.destroy', item.id)
                                    )
                                "
                            >
                                <i class="ri-delete-bin-line"></i>
                            </AppButton>
                        </AppTooltip>
                    </AppDataTableData>
                </AppDataTableRow>
            </tbody>
        </template>
    </AppDataTable>

    <AppPaginator
        :links="authors.links"
        class="mt-4 justify-center"
    ></AppPaginator>

    <AppAlert v-if="!authors.data.length" class="mt-4">
        No authors found.
    </AppAlert>

    <AppConfirmDialog ref="confirmDialogRef"></AppConfirmDialog>
</template>

<script setup>
import { ref } from 'vue'

const props = defineProps({
    authors: {
        type: Object,
        default: () => {}
    }
})

const breadCrumb = [
    { label: 'Home', href: route('dashboard.index') },
    { label: 'Authors', last: true }
]

const headers = ['ID', 'Name', 'Country', 'Actions']

const confirmDialogRef = ref(null)
const confirmDelete = (deleteRoute) => {
    confirmDialogRef.value.openModal(deleteRoute)
}
</script>
