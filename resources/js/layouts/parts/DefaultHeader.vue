<script setup lang="ts">
import {
    NavigationMenuContent,
    NavigationMenuItem,
    NavigationMenuList,
    NavigationMenuRoot,
    NavigationMenuTrigger,
    NavigationMenuViewport,
} from 'reka-ui'
</script>

<template>
    <NavigationMenuRoot>
        <NavigationMenuList>
            <NavigationMenuItem>
                <NavigationMenuTrigger>Item one</NavigationMenuTrigger>
                <NavigationMenuContent>Item one content</NavigationMenuContent>
            </NavigationMenuItem>
            <NavigationMenuItem>
                <NavigationMenuTrigger>Item two</NavigationMenuTrigger>
                <NavigationMenuContent>Item two content</NavigationMenuContent>
            </NavigationMenuItem>
        </NavigationMenuList>
        <NavigationMenuViewport />
    </NavigationMenuRoot>
</template>
