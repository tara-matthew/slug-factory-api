<template>
    <div class="w-1/5">
        <MoleculeBaseCard>
            <template #image>
                <img src="https://fastly.picsum.photos/id/404/200/300.jpg?hmac=1i6ra6DJN9kJ9AQVfSf3VD1w08FkegBgXuz9lNDk1OM" alt="" class="w-full h-48 object-cover">
            </template>
            <template #title>
                <AtomBaseTitle tag="h2" content="Card title" />
            </template>
            <template #content>
                <p>Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            </template>
            <template #footer>
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Go somewhere
                </button>
            </template>
        </MoleculeBaseCard>
    </div>
</template>
