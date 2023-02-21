<x-layout>
    <!-- Hero Section Begin -->
    <x-Home.hero_section />
    <!-- Hero Section End -->

    <!-- Banner Section Begin -->
    <x-Home.banner_section />
    <!-- Banner Section End -->

    <!-- Product Section Begin -->
    <x-Home.product_section :products="$products"/>
    <!-- Product Section End -->

    <!-- Categories Section Begin -->
    <x-Home.categories_section/>
    <!-- Categories Section End -->

    <!-- Instagram Section Begin -->
    <x-Home.instagram_section/>
    <!-- Instagram Section End -->

    <!-- Latest Blog Section Begin -->
    <x-Home.latest_blog_section/>
    <!-- Latest Blog Section End -->
</x-layout>
