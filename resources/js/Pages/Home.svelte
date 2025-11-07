<script lang="ts">
    export let auth: { user: { name: string } | null } | undefined;
</script>

<h1>ようこそ</h1>
{#if auth?.user}
    <p>ログイン中: {auth.user.name}</p>
{:else}
    <p>未ログイン</p>
{/if}
