<template>
<div class="AI_Tool_text_frame">
    <div class="nav_bar_ai_text">
        <div class="radio">
            <div>
                <input
                    @click="pagination_text(0)"
                    label="All Template"
                    type="radio"
                    id="male"
                    name="tabs"
                    checked=""
                />
            </div>
            <div  v-for="(navbar,index) in $page.props.auth.AiText.navbar[0]">
                <input
                @click="pagination_text(index+1)"
                :label="navbar.name"
                type="radio"
                id="male"
                name="tabs"
            />
            </div>
        </div>
    </div>
    <div class="frame_ai_text">
        <div v-if="page1">
            <p class="header_categorie">
                <span class="title">{{ $page.props.auth.AiText.navbar[0][0].name}}</span>
                <span class="description">{{ $page.props.auth.AiText.navbar[0][0].description}}</span>
            </p>
            <div class="cards">
                <div class="card" :class="{'freemCard': navbar.Free, 'proCard': navbar.pro, 'premiumCard': navbar.premium}" v-for="(navbar,index) in $page.props.auth.AiText.undercat1[0]">
                    <div class="card_header">
                        <p v-html="navbar.logo" class="mb-4" :style="{backgroundColor: navbar.color , color: navbar.logo_color}"></p>
                        <div class="star">
                            <label class="container">
                                <input type="checkbox"  @click="addFavorit_text(navbar.id)" :checked="navbar.id === navbar.id_tool">
                                <svg height="24px" id="Layer_1" version="1.2" viewBox="0 0 24 24" width="24px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g><g><path d="M9.362,9.158c0,0-3.16,0.35-5.268,0.584c-0.19,0.023-0.358,0.15-0.421,0.343s0,0.394,0.14,0.521    c1.566,1.429,3.919,3.569,3.919,3.569c-0.002,0-0.646,3.113-1.074,5.19c-0.036,0.188,0.032,0.387,0.196,0.506    c0.163,0.119,0.373,0.121,0.538,0.028c1.844-1.048,4.606-2.624,4.606-2.624s2.763,1.576,4.604,2.625    c0.168,0.092,0.378,0.09,0.541-0.029c0.164-0.119,0.232-0.318,0.195-0.505c-0.428-2.078-1.071-5.191-1.071-5.191    s2.353-2.14,3.919-3.566c0.14-0.131,0.202-0.332,0.14-0.524s-0.23-0.319-0.42-0.341c-2.108-0.236-5.269-0.586-5.269-0.586    s-1.31-2.898-2.183-4.83c-0.082-0.173-0.254-0.294-0.456-0.294s-0.375,0.122-0.453,0.294C10.671,6.26,9.362,9.158,9.362,9.158z"></path></g></g></svg>
                            </label>
                        </div>
                    </div>
                    <div v-if="$page.props.auth.user.payment" class="desc_card">
                        <div v-if="$page.props.auth.user.special_user || (navbar.premium && $page.props.auth.user_plan[0].title == 'Premium')">
                            <Link class="title" :href="`ai_tools_template/${navbar.id}`">{{ navbar.title }}</Link>
                            <Link class="description" :href="`ai_tools_template/${navbar.id}`">{{ navbar.description }}</Link>
                        </div>
                        <div v-else-if="$page.props.auth.user.special_user || (navbar.pro && ($page.props.auth.user_plan[0].title == 'Pro' || $page.props.auth.user_plan[0].title == 'Premium'))">
                            <Link class="title" :href="`ai_tools_template/${navbar.id}`">{{ navbar.title }}</Link>
                            <Link class="description" :href="`ai_tools_template/${navbar.id}`">{{ navbar.description }}</Link>
                        </div>
                        <div v-else-if="$page.props.auth.user.special_user || (navbar.Standard && ($page.props.auth.user_plan[0].title == 'Standard' || $page.props.auth.user_plan[0].title == 'Pro' || $page.props.auth.user_plan[0].title == 'Premium'))">
                            <Link class="title" :href="`ai_tools_template/${navbar.id}`">{{ navbar.title }}</Link>
                            <Link class="description" :href="`ai_tools_template/${navbar.id}`">{{ navbar.description }}</Link>
                        </div>
                        <div v-else-if="$page.props.auth.user.special_user || (navbar.Free && ($page.props.auth.user_plan[0].title == 'Standard' || $page.props.auth.user_plan[0].title == 'Pro' || $page.props.auth.user_plan[0].title == 'Premium'))">
                            <Link class="title" :href="`ai_tools_template/${navbar.id}`">{{ navbar.title }}</Link>
                            <Link class="description" :href="`ai_tools_template/${navbar.id}`">{{ navbar.description }}</Link>
                        </div>
                        <div v-else>
                            <p class="title" @click="need_subscription_popup_fun(navbar.premium,navbar.pro,navbar.Free)">{{ navbar.title }}</p>
                            <p class="description" @click="need_subscription_popup_fun(navbar.premium,navbar.pro,navbar.Free)">{{ navbar.description }}</p>
                        </div>
                    </div>
                    <div v-else-if="navbar.Free" class="desc_card">
                        <div>
                            <Link class="title" :href="`ai_tools_template/${navbar.id}`">{{ navbar.title }}</Link>
                            <Link class="description" :href="`ai_tools_template/${navbar.id}`">{{ navbar.description }}</Link>
                        </div>
                    </div>
                    <div v-else>
                        <p class="title" @click="need_subscription_popup_fun(navbar.premium,navbar.pro,navbar.Free)">{{ navbar.title }}</p>
                        <p class="description" @click="need_subscription_popup_fun(navbar.premium,navbar.pro,navbar.Free)">{{ navbar.description }}</p>
                    </div>
                    <div class="plan_level">
                        <p v-if="navbar.premium" class="Premium"><i class="fa-solid fa-gem"></i>Premium</p>
                        <p v-else-if="navbar.pro" class="Pro"><i class="fa-solid fa-crown"></i>Pro</p>
                        <p v-else-if="navbar.Free" class="Free"><i class="fa-solid fa-gift"></i>Free</p>
                    </div>
                </div>
            </div>

            <p class="header_categorie">
                <span class="title">{{ $page.props.auth.AiText.navbar[0][1].name}}</span>
                <span class="description">{{ $page.props.auth.AiText.navbar[0][1].description}}</span>
            </p>
            <div class="cards">
                <div class="card" :class="{'freemCard': navbar.Free, 'proCard': navbar.pro, 'premiumCard': navbar.premium}" v-for="(navbar,index) in $page.props.auth.AiText.undercat2[0]">
                    <div class="card_header">
                        <p v-html="navbar.logo" class="mb-4" :style="{backgroundColor: navbar.color , color: navbar.logo_color}"></p>
                        <div class="star">
                    <label class="container">
                        <input type="checkbox"  @click="addFavorit_text(navbar.id)" :checked="navbar.id === navbar.id_tool">
                        <svg height="24px" id="Layer_1" version="1.2" viewBox="0 0 24 24" width="24px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g><g><path d="M9.362,9.158c0,0-3.16,0.35-5.268,0.584c-0.19,0.023-0.358,0.15-0.421,0.343s0,0.394,0.14,0.521    c1.566,1.429,3.919,3.569,3.919,3.569c-0.002,0-0.646,3.113-1.074,5.19c-0.036,0.188,0.032,0.387,0.196,0.506    c0.163,0.119,0.373,0.121,0.538,0.028c1.844-1.048,4.606-2.624,4.606-2.624s2.763,1.576,4.604,2.625    c0.168,0.092,0.378,0.09,0.541-0.029c0.164-0.119,0.232-0.318,0.195-0.505c-0.428-2.078-1.071-5.191-1.071-5.191    s2.353-2.14,3.919-3.566c0.14-0.131,0.202-0.332,0.14-0.524s-0.23-0.319-0.42-0.341c-2.108-0.236-5.269-0.586-5.269-0.586    s-1.31-2.898-2.183-4.83c-0.082-0.173-0.254-0.294-0.456-0.294s-0.375,0.122-0.453,0.294C10.671,6.26,9.362,9.158,9.362,9.158z"></path></g></g></svg>
                    </label>
                </div>
                    </div>
                    <div v-if="$page.props.auth.user.payment" class="desc_card">
                        <div v-if="$page.props.auth.user.special_user || (navbar.premium && $page.props.auth.user_plan[0].title == 'Premium')">
                            <Link class="title" :href="`ai_tools_template/${navbar.id}`">{{ navbar.title }}</Link>
                            <Link class="description" :href="`ai_tools_template/${navbar.id}`">{{ navbar.description }}</Link>
                        </div>
                        <div v-else-if="$page.props.auth.user.special_user || (navbar.pro && ($page.props.auth.user_plan[0].title == 'Pro' || $page.props.auth.user_plan[0].title == 'Premium'))">
                            <Link class="title" :href="`ai_tools_template/${navbar.id}`">{{ navbar.title }}</Link>
                            <Link class="description" :href="`ai_tools_template/${navbar.id}`">{{ navbar.description }}</Link>
                        </div>
                        <div v-else-if="$page.props.auth.user.special_user || (navbar.Standard && ($page.props.auth.user_plan[0].title == 'Standard' || $page.props.auth.user_plan[0].title == 'Pro' || $page.props.auth.user_plan[0].title == 'Premium'))">
                            <Link class="title" :href="`ai_tools_template/${navbar.id}`">{{ navbar.title }}</Link>
                            <Link class="description" :href="`ai_tools_template/${navbar.id}`">{{ navbar.description }}</Link>
                        </div>
                        <div v-else-if="$page.props.auth.user.special_user || (navbar.Free && ($page.props.auth.user_plan[0].title == 'Standard' || $page.props.auth.user_plan[0].title == 'Pro' || $page.props.auth.user_plan[0].title == 'Premium'))">
                            <Link class="title" :href="`ai_tools_template/${navbar.id}`">{{ navbar.title }}</Link>
                            <Link class="description" :href="`ai_tools_template/${navbar.id}`">{{ navbar.description }}</Link>
                        </div>
                        <div v-else>
                            <p class="title" @click="need_subscription_popup_fun(navbar.premium,navbar.pro,navbar.Free)">{{ navbar.title }}</p>
                            <p class="description" @click="need_subscription_popup_fun(navbar.premium,navbar.pro,navbar.Free)">{{ navbar.description }}</p>
                        </div>
                    </div>
                    <div v-else-if="navbar.Free" class="desc_card">
                        <div>
                            <Link class="title" :href="`ai_tools_template/${navbar.id}`">{{ navbar.title }}</Link>
                            <Link class="description" :href="`ai_tools_template/${navbar.id}`">{{ navbar.description }}</Link>
                        </div>
                    </div>
                    <div v-else>
                        <p class="title" @click="need_subscription_popup_fun(navbar.premium,navbar.pro,navbar.Free)">{{ navbar.title }}</p>
                        <p class="description" @click="need_subscription_popup_fun(navbar.premium,navbar.pro,navbar.Free)">{{ navbar.description }}</p>
                    </div>
                    <div class="plan_level">
                        <p v-if="navbar.premium" class="Premium"><i class="fa-solid fa-gem"></i>Premium</p>
                        <p v-else-if="navbar.pro" class="Pro"><i class="fa-solid fa-crown"></i>Pro</p>
                        <p v-else-if="navbar.Free" class="Free"><i class="fa-solid fa-gift"></i>Free</p>
                    </div>
                </div>
            </div>

            <p class="header_categorie">
                <span class="title">{{ $page.props.auth.AiText.navbar[0][2].name}}</span>
                <span class="description">{{ $page.props.auth.AiText.navbar[0][2].description}}</span>
            </p>
            <div class="cards">
                <div class="card" :class="{'freemCard': navbar.Free, 'proCard': navbar.pro, 'premiumCard': navbar.premium}" v-for="(navbar,index) in $page.props.auth.AiText.undercat3[0]">
                    <div class="card_header">
                        <p v-html="navbar.logo" class="mb-4" :style="{backgroundColor: navbar.color , color: navbar.logo_color}"></p>
                        <div class="star">
                    <label class="container">
                        <input type="checkbox"  @click="addFavorit_text(navbar.id)" :checked="navbar.id === navbar.id_tool">
                        <svg height="24px" id="Layer_1" version="1.2" viewBox="0 0 24 24" width="24px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g><g><path d="M9.362,9.158c0,0-3.16,0.35-5.268,0.584c-0.19,0.023-0.358,0.15-0.421,0.343s0,0.394,0.14,0.521    c1.566,1.429,3.919,3.569,3.919,3.569c-0.002,0-0.646,3.113-1.074,5.19c-0.036,0.188,0.032,0.387,0.196,0.506    c0.163,0.119,0.373,0.121,0.538,0.028c1.844-1.048,4.606-2.624,4.606-2.624s2.763,1.576,4.604,2.625    c0.168,0.092,0.378,0.09,0.541-0.029c0.164-0.119,0.232-0.318,0.195-0.505c-0.428-2.078-1.071-5.191-1.071-5.191    s2.353-2.14,3.919-3.566c0.14-0.131,0.202-0.332,0.14-0.524s-0.23-0.319-0.42-0.341c-2.108-0.236-5.269-0.586-5.269-0.586    s-1.31-2.898-2.183-4.83c-0.082-0.173-0.254-0.294-0.456-0.294s-0.375,0.122-0.453,0.294C10.671,6.26,9.362,9.158,9.362,9.158z"></path></g></g></svg>
                    </label>
                </div>
                    </div>
                    <div v-if="$page.props.auth.user.payment" class="desc_card">
                        <div v-if="$page.props.auth.user.special_user || (navbar.premium && $page.props.auth.user_plan[0].title == 'Premium')">
                            <Link class="title" :href="`ai_tools_template/${navbar.id}`">{{ navbar.title }}</Link>
                            <Link class="description" :href="`ai_tools_template/${navbar.id}`">{{ navbar.description }}</Link>
                        </div>
                        <div v-else-if="$page.props.auth.user.special_user || (navbar.pro && ($page.props.auth.user_plan[0].title == 'Pro' || $page.props.auth.user_plan[0].title == 'Premium'))">
                            <Link class="title" :href="`ai_tools_template/${navbar.id}`">{{ navbar.title }}</Link>
                            <Link class="description" :href="`ai_tools_template/${navbar.id}`">{{ navbar.description }}</Link>
                        </div>
                        <div v-else-if="$page.props.auth.user.special_user || (navbar.Standard && ($page.props.auth.user_plan[0].title == 'Standard' || $page.props.auth.user_plan[0].title == 'Pro' || $page.props.auth.user_plan[0].title == 'Premium'))">
                            <Link class="title" :href="`ai_tools_template/${navbar.id}`">{{ navbar.title }}</Link>
                            <Link class="description" :href="`ai_tools_template/${navbar.id}`">{{ navbar.description }}</Link>
                        </div>
                        <div v-else-if="$page.props.auth.user.special_user || (navbar.Free && ($page.props.auth.user_plan[0].title == 'Standard' || $page.props.auth.user_plan[0].title == 'Pro' || $page.props.auth.user_plan[0].title == 'Premium'))">
                            <Link class="title" :href="`ai_tools_template/${navbar.id}`">{{ navbar.title }}</Link>
                            <Link class="description" :href="`ai_tools_template/${navbar.id}`">{{ navbar.description }}</Link>
                        </div>
                        <div v-else>
                            <p class="title" @click="need_subscription_popup_fun(navbar.premium,navbar.pro,navbar.Free)">{{ navbar.title }}</p>
                            <p class="description" @click="need_subscription_popup_fun(navbar.premium,navbar.pro,navbar.Free)">{{ navbar.description }}</p>
                        </div>
                    </div>
                    <div v-else-if="navbar.Free" class="desc_card">
                        <div>
                            <Link class="title" :href="`ai_tools_template/${navbar.id}`">{{ navbar.title }}</Link>
                            <Link class="description" :href="`ai_tools_template/${navbar.id}`">{{ navbar.description }}</Link>
                        </div>
                    </div>
                    <div v-else>
                        <p class="title" @click="need_subscription_popup_fun(navbar.premium,navbar.pro,navbar.Free)">{{ navbar.title }}</p>
                        <p class="description" @click="need_subscription_popup_fun(navbar.premium,navbar.pro,navbar.Free)">{{ navbar.description }}</p>
                    </div>
                    <div class="plan_level">
                        <p v-if="navbar.premium" class="Premium"><i class="fa-solid fa-gem"></i>Premium</p>
                        <p v-else-if="navbar.pro" class="Pro"><i class="fa-solid fa-crown"></i>Pro</p>
                        <p v-else-if="navbar.Free" class="Free"><i class="fa-solid fa-gift"></i>Free</p>
                    </div>
                </div>
            </div>

            <p class="header_categorie">
                <span class="title">{{ $page.props.auth.AiText.navbar[0][3].name}}</span>
                <span class="description">{{ $page.props.auth.AiText.navbar[0][3].description}}</span>
            </p>
            <div class="cards">
                <div class="card" :class="{'freemCard': navbar.Free, 'proCard': navbar.pro, 'premiumCard': navbar.premium}" v-for="(navbar,index) in $page.props.auth.AiText.undercat4[0]">
                    <div class="card_header">
                        <p v-html="navbar.logo" class="mb-4" :style="{backgroundColor: navbar.color , color: navbar.logo_color}"></p>
                        <div class="star">
                    <label class="container">
                        <input type="checkbox"  @click="addFavorit_text(navbar.id)" :checked="navbar.id === navbar.id_tool">
                        <svg height="24px" id="Layer_1" version="1.2" viewBox="0 0 24 24" width="24px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g><g><path d="M9.362,9.158c0,0-3.16,0.35-5.268,0.584c-0.19,0.023-0.358,0.15-0.421,0.343s0,0.394,0.14,0.521    c1.566,1.429,3.919,3.569,3.919,3.569c-0.002,0-0.646,3.113-1.074,5.19c-0.036,0.188,0.032,0.387,0.196,0.506    c0.163,0.119,0.373,0.121,0.538,0.028c1.844-1.048,4.606-2.624,4.606-2.624s2.763,1.576,4.604,2.625    c0.168,0.092,0.378,0.09,0.541-0.029c0.164-0.119,0.232-0.318,0.195-0.505c-0.428-2.078-1.071-5.191-1.071-5.191    s2.353-2.14,3.919-3.566c0.14-0.131,0.202-0.332,0.14-0.524s-0.23-0.319-0.42-0.341c-2.108-0.236-5.269-0.586-5.269-0.586    s-1.31-2.898-2.183-4.83c-0.082-0.173-0.254-0.294-0.456-0.294s-0.375,0.122-0.453,0.294C10.671,6.26,9.362,9.158,9.362,9.158z"></path></g></g></svg>
                    </label>
                </div>
                    </div>
                    <div v-if="$page.props.auth.user.payment" class="desc_card">
                        <div v-if="$page.props.auth.user.special_user || (navbar.premium && $page.props.auth.user_plan[0].title == 'Premium')">
                            <Link class="title" :href="`ai_tools_template/${navbar.id}`">{{ navbar.title }}</Link>
                            <Link class="description" :href="`ai_tools_template/${navbar.id}`">{{ navbar.description }}</Link>
                        </div>
                        <div v-else-if="$page.props.auth.user.special_user || (navbar.pro && ($page.props.auth.user_plan[0].title == 'Pro' || $page.props.auth.user_plan[0].title == 'Premium'))">
                            <Link class="title" :href="`ai_tools_template/${navbar.id}`">{{ navbar.title }}</Link>
                            <Link class="description" :href="`ai_tools_template/${navbar.id}`">{{ navbar.description }}</Link>
                        </div>
                        <div v-else-if="$page.props.auth.user.special_user || (navbar.Standard && ($page.props.auth.user_plan[0].title == 'Standard' || $page.props.auth.user_plan[0].title == 'Pro' || $page.props.auth.user_plan[0].title == 'Premium'))">
                            <Link class="title" :href="`ai_tools_template/${navbar.id}`">{{ navbar.title }}</Link>
                            <Link class="description" :href="`ai_tools_template/${navbar.id}`">{{ navbar.description }}</Link>
                        </div>
                        <div v-else-if="$page.props.auth.user.special_user || (navbar.Free && ($page.props.auth.user_plan[0].title == 'Standard' || $page.props.auth.user_plan[0].title == 'Pro' || $page.props.auth.user_plan[0].title == 'Premium'))">
                            <Link class="title" :href="`ai_tools_template/${navbar.id}`">{{ navbar.title }}</Link>
                            <Link class="description" :href="`ai_tools_template/${navbar.id}`">{{ navbar.description }}</Link>
                        </div>
                        <div v-else>
                            <p class="title" @click="need_subscription_popup_fun(navbar.premium,navbar.pro,navbar.Free)">{{ navbar.title }}</p>
                            <p class="description" @click="need_subscription_popup_fun(navbar.premium,navbar.pro,navbar.Free)">{{ navbar.description }}</p>
                        </div>
                    </div>
                    <div v-else-if="navbar.Free" class="desc_card">
                        <div>
                            <Link class="title" :href="`ai_tools_template/${navbar.id}`">{{ navbar.title }}</Link>
                            <Link class="description" :href="`ai_tools_template/${navbar.id}`">{{ navbar.description }}</Link>
                        </div>
                    </div>
                    <div v-else>
                        <p class="title" @click="need_subscription_popup_fun(navbar.premium,navbar.pro,navbar.Free)">{{ navbar.title }}</p>
                        <p class="description" @click="need_subscription_popup_fun(navbar.premium,navbar.pro,navbar.Free)">{{ navbar.description }}</p>
                    </div>
                    <div class="plan_level">
                        <p v-if="navbar.premium" class="Premium"><i class="fa-solid fa-gem"></i>Premium</p>
                        <p v-else-if="navbar.pro" class="Pro"><i class="fa-solid fa-crown"></i>Pro</p>
                        <p v-else-if="navbar.Free" class="Free"><i class="fa-solid fa-gift"></i>Free</p>
                    </div>
                </div>
            </div>

            <p class="header_categorie">
                <span class="title">{{ $page.props.auth.AiText.navbar[0][4].name}}</span>
                <span class="description">{{ $page.props.auth.AiText.navbar[0][4].description}}</span>
            </p>
            <div class="cards">
                <div class="card" :class="{'freemCard': navbar.Free, 'proCard': navbar.pro, 'premiumCard': navbar.premium}" v-for="(navbar,index) in $page.props.auth.AiText.undercat5[0]">
                    <div class="card_header">
                        <p v-html="navbar.logo" class="mb-4" :style="{backgroundColor: navbar.color , color: navbar.logo_color}"></p>
                        <div class="star">
                    <label class="container">
                        <input type="checkbox"  @click="addFavorit_text(navbar.id)" :checked="navbar.id === navbar.id_tool">
                        <svg height="24px" id="Layer_1" version="1.2" viewBox="0 0 24 24" width="24px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g><g><path d="M9.362,9.158c0,0-3.16,0.35-5.268,0.584c-0.19,0.023-0.358,0.15-0.421,0.343s0,0.394,0.14,0.521    c1.566,1.429,3.919,3.569,3.919,3.569c-0.002,0-0.646,3.113-1.074,5.19c-0.036,0.188,0.032,0.387,0.196,0.506    c0.163,0.119,0.373,0.121,0.538,0.028c1.844-1.048,4.606-2.624,4.606-2.624s2.763,1.576,4.604,2.625    c0.168,0.092,0.378,0.09,0.541-0.029c0.164-0.119,0.232-0.318,0.195-0.505c-0.428-2.078-1.071-5.191-1.071-5.191    s2.353-2.14,3.919-3.566c0.14-0.131,0.202-0.332,0.14-0.524s-0.23-0.319-0.42-0.341c-2.108-0.236-5.269-0.586-5.269-0.586    s-1.31-2.898-2.183-4.83c-0.082-0.173-0.254-0.294-0.456-0.294s-0.375,0.122-0.453,0.294C10.671,6.26,9.362,9.158,9.362,9.158z"></path></g></g></svg>
                    </label>
                </div>
                    </div>
                    <div v-if="$page.props.auth.user.payment" class="desc_card">
                        <div v-if="$page.props.auth.user.special_user || (navbar.premium && $page.props.auth.user_plan[0].title == 'Premium')">
                            <Link class="title" :href="`ai_tools_template/${navbar.id}`">{{ navbar.title }}</Link>
                            <Link class="description" :href="`ai_tools_template/${navbar.id}`">{{ navbar.description }}</Link>
                        </div>
                        <div v-else-if="$page.props.auth.user.special_user || (navbar.pro && ($page.props.auth.user_plan[0].title == 'Pro' || $page.props.auth.user_plan[0].title == 'Premium'))">
                            <Link class="title" :href="`ai_tools_template/${navbar.id}`">{{ navbar.title }}</Link>
                            <Link class="description" :href="`ai_tools_template/${navbar.id}`">{{ navbar.description }}</Link>
                        </div>
                        <div v-else-if="$page.props.auth.user.special_user || (navbar.Standard && ($page.props.auth.user_plan[0].title == 'Standard' || $page.props.auth.user_plan[0].title == 'Pro' || $page.props.auth.user_plan[0].title == 'Premium'))">
                            <Link class="title" :href="`ai_tools_template/${navbar.id}`">{{ navbar.title }}</Link>
                            <Link class="description" :href="`ai_tools_template/${navbar.id}`">{{ navbar.description }}</Link>
                        </div>
                        <div v-else-if="$page.props.auth.user.special_user || (navbar.Free && ($page.props.auth.user_plan[0].title == 'Standard' || $page.props.auth.user_plan[0].title == 'Pro' || $page.props.auth.user_plan[0].title == 'Premium'))">
                            <Link class="title" :href="`ai_tools_template/${navbar.id}`">{{ navbar.title }}</Link>
                            <Link class="description" :href="`ai_tools_template/${navbar.id}`">{{ navbar.description }}</Link>
                        </div>
                        <div v-else>
                            <p class="title" @click="need_subscription_popup_fun(navbar.premium,navbar.pro,navbar.Free)">{{ navbar.title }}</p>
                            <p class="description" @click="need_subscription_popup_fun(navbar.premium,navbar.pro,navbar.Free)">{{ navbar.description }}</p>
                        </div>
                    </div>
                    <div v-else-if="navbar.Free" class="desc_card">
                        <div>
                            <Link class="title" :href="`ai_tools_template/${navbar.id}`">{{ navbar.title }}</Link>
                            <Link class="description" :href="`ai_tools_template/${navbar.id}`">{{ navbar.description }}</Link>
                        </div>
                    </div>
                    <div v-else>
                        <p class="title" @click="need_subscription_popup_fun(navbar.premium,navbar.pro,navbar.Free)">{{ navbar.title }}</p>
                        <p class="description" @click="need_subscription_popup_fun(navbar.premium,navbar.pro,navbar.Free)">{{ navbar.description }}</p>
                    </div>
                    <div class="plan_level">
                        <p v-if="navbar.premium" class="Premium"><i class="fa-solid fa-gem"></i>Premium</p>
                        <p v-else-if="navbar.pro" class="Pro"><i class="fa-solid fa-crown"></i>Pro</p>
                        <p v-else-if="navbar.Free" class="Free"><i class="fa-solid fa-gift"></i>Free</p>
                    </div>
                </div>
            </div>

            <p class="header_categorie">
                <span class="title">{{ $page.props.auth.AiText.navbar[0][5].name}}</span>
                <span class="description">{{ $page.props.auth.AiText.navbar[0][5].description}}</span>
            </p>
            <div class="cards">
                <div class="card" :class="{'freemCard': navbar.Free, 'proCard': navbar.pro, 'premiumCard': navbar.premium}" v-for="(navbar,index) in $page.props.auth.AiText.undercat6[0]">
                    <div class="card_header">
                        <p v-html="navbar.logo" class="mb-4" :style="{backgroundColor: navbar.color , color: navbar.logo_color}"></p>
                        <div class="star">
                    <label class="container">
                        <input type="checkbox"  @click="addFavorit_text(navbar.id)" :checked="navbar.id === navbar.id_tool">
                        <svg height="24px" id="Layer_1" version="1.2" viewBox="0 0 24 24" width="24px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g><g><path d="M9.362,9.158c0,0-3.16,0.35-5.268,0.584c-0.19,0.023-0.358,0.15-0.421,0.343s0,0.394,0.14,0.521    c1.566,1.429,3.919,3.569,3.919,3.569c-0.002,0-0.646,3.113-1.074,5.19c-0.036,0.188,0.032,0.387,0.196,0.506    c0.163,0.119,0.373,0.121,0.538,0.028c1.844-1.048,4.606-2.624,4.606-2.624s2.763,1.576,4.604,2.625    c0.168,0.092,0.378,0.09,0.541-0.029c0.164-0.119,0.232-0.318,0.195-0.505c-0.428-2.078-1.071-5.191-1.071-5.191    s2.353-2.14,3.919-3.566c0.14-0.131,0.202-0.332,0.14-0.524s-0.23-0.319-0.42-0.341c-2.108-0.236-5.269-0.586-5.269-0.586    s-1.31-2.898-2.183-4.83c-0.082-0.173-0.254-0.294-0.456-0.294s-0.375,0.122-0.453,0.294C10.671,6.26,9.362,9.158,9.362,9.158z"></path></g></g></svg>
                    </label>
                </div>
                    </div>
                    <div v-if="$page.props.auth.user.payment" class="desc_card">
                        <div v-if="$page.props.auth.user.special_user || (navbar.premium && $page.props.auth.user_plan[0].title == 'Premium')">
                            <Link class="title" :href="`ai_tools_template/${navbar.id}`">{{ navbar.title }}</Link>
                            <Link class="description" :href="`ai_tools_template/${navbar.id}`">{{ navbar.description }}</Link>
                        </div>
                        <div v-else-if="$page.props.auth.user.special_user || (navbar.pro && ($page.props.auth.user_plan[0].title == 'Pro' || $page.props.auth.user_plan[0].title == 'Premium'))">
                            <Link class="title" :href="`ai_tools_template/${navbar.id}`">{{ navbar.title }}</Link>
                            <Link class="description" :href="`ai_tools_template/${navbar.id}`">{{ navbar.description }}</Link>
                        </div>
                        <div v-else-if="$page.props.auth.user.special_user || (navbar.Standard && ($page.props.auth.user_plan[0].title == 'Standard' || $page.props.auth.user_plan[0].title == 'Pro' || $page.props.auth.user_plan[0].title == 'Premium'))">
                            <Link class="title" :href="`ai_tools_template/${navbar.id}`">{{ navbar.title }}</Link>
                            <Link class="description" :href="`ai_tools_template/${navbar.id}`">{{ navbar.description }}</Link>
                        </div>
                        <div v-else-if="$page.props.auth.user.special_user || (navbar.Free && ($page.props.auth.user_plan[0].title == 'Standard' || $page.props.auth.user_plan[0].title == 'Pro' || $page.props.auth.user_plan[0].title == 'Premium'))">
                            <Link class="title" :href="`ai_tools_template/${navbar.id}`">{{ navbar.title }}</Link>
                            <Link class="description" :href="`ai_tools_template/${navbar.id}`">{{ navbar.description }}</Link>
                        </div>
                        <div v-else>
                            <p class="title" @click="need_subscription_popup_fun(navbar.premium,navbar.pro,navbar.Free)">{{ navbar.title }}</p>
                            <p class="description" @click="need_subscription_popup_fun(navbar.premium,navbar.pro,navbar.Free)">{{ navbar.description }}</p>
                        </div>
                    </div>
                    <div v-else-if="navbar.Free" class="desc_card">
                        <div>
                            <Link class="title" :href="`ai_tools_template/${navbar.id}`">{{ navbar.title }}</Link>
                            <Link class="description" :href="`ai_tools_template/${navbar.id}`">{{ navbar.description }}</Link>
                        </div>
                    </div>
                    <div v-else>
                        <p class="title" @click="need_subscription_popup_fun(navbar.premium,navbar.pro,navbar.Free)">{{ navbar.title }}</p>
                        <p class="description" @click="need_subscription_popup_fun(navbar.premium,navbar.pro,navbar.Free)">{{ navbar.description }}</p>
                    </div>
                    <div class="plan_level">
                        <p v-if="navbar.premium" class="Premium"><i class="fa-solid fa-gem"></i>Premium</p>
                        <p v-else-if="navbar.pro" class="Pro"><i class="fa-solid fa-crown"></i>Pro</p>
                        <p v-else-if="navbar.Free" class="Free"><i class="fa-solid fa-gift"></i>Free</p>
                    </div>
                </div>
            </div>

            <p class="header_categorie">
                <span class="title">{{ $page.props.auth.AiText.navbar[0][6].name}}</span>
                <span class="description">{{ $page.props.auth.AiText.navbar[0][6].description}}</span>
            </p>
            <div class="cards">
                <div class="card" :class="{'freemCard': navbar.Free, 'proCard': navbar.pro, 'premiumCard': navbar.premium}" v-for="(navbar,index) in $page.props.auth.AiText.undercat7[0]">
                    <div class="card_header">
                        <p v-html="navbar.logo" class="mb-4" :style="{backgroundColor: navbar.color , color: navbar.logo_color}"></p>
                        <div class="star">
                    <label class="container">
                        <input type="checkbox"  @click="addFavorit_text(navbar.id)" :checked="navbar.id === navbar.id_tool">
                        <svg height="24px" id="Layer_1" version="1.2" viewBox="0 0 24 24" width="24px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g><g><path d="M9.362,9.158c0,0-3.16,0.35-5.268,0.584c-0.19,0.023-0.358,0.15-0.421,0.343s0,0.394,0.14,0.521    c1.566,1.429,3.919,3.569,3.919,3.569c-0.002,0-0.646,3.113-1.074,5.19c-0.036,0.188,0.032,0.387,0.196,0.506    c0.163,0.119,0.373,0.121,0.538,0.028c1.844-1.048,4.606-2.624,4.606-2.624s2.763,1.576,4.604,2.625    c0.168,0.092,0.378,0.09,0.541-0.029c0.164-0.119,0.232-0.318,0.195-0.505c-0.428-2.078-1.071-5.191-1.071-5.191    s2.353-2.14,3.919-3.566c0.14-0.131,0.202-0.332,0.14-0.524s-0.23-0.319-0.42-0.341c-2.108-0.236-5.269-0.586-5.269-0.586    s-1.31-2.898-2.183-4.83c-0.082-0.173-0.254-0.294-0.456-0.294s-0.375,0.122-0.453,0.294C10.671,6.26,9.362,9.158,9.362,9.158z"></path></g></g></svg>
                    </label>
                </div>
                    </div>
                    <div v-if="$page.props.auth.user.payment" class="desc_card">
                        <div v-if="$page.props.auth.user.special_user || (navbar.premium && $page.props.auth.user_plan[0].title == 'Premium')">
                            <Link class="title" :href="`ai_tools_template/${navbar.id}`">{{ navbar.title }}</Link>
                            <Link class="description" :href="`ai_tools_template/${navbar.id}`">{{ navbar.description }}</Link>
                        </div>
                        <div v-else-if="$page.props.auth.user.special_user || (navbar.pro && ($page.props.auth.user_plan[0].title == 'Pro' || $page.props.auth.user_plan[0].title == 'Premium'))">
                            <Link class="title" :href="`ai_tools_template/${navbar.id}`">{{ navbar.title }}</Link>
                            <Link class="description" :href="`ai_tools_template/${navbar.id}`">{{ navbar.description }}</Link>
                        </div>
                        <div v-else-if="$page.props.auth.user.special_user || (navbar.Standard && ($page.props.auth.user_plan[0].title == 'Standard' || $page.props.auth.user_plan[0].title == 'Pro' || $page.props.auth.user_plan[0].title == 'Premium'))">
                            <Link class="title" :href="`ai_tools_template/${navbar.id}`">{{ navbar.title }}</Link>
                            <Link class="description" :href="`ai_tools_template/${navbar.id}`">{{ navbar.description }}</Link>
                        </div>
                        <div v-else-if="$page.props.auth.user.special_user || (navbar.Free && ($page.props.auth.user_plan[0].title == 'Standard' || $page.props.auth.user_plan[0].title == 'Pro' || $page.props.auth.user_plan[0].title == 'Premium'))">
                            <Link class="title" :href="`ai_tools_template/${navbar.id}`">{{ navbar.title }}</Link>
                            <Link class="description" :href="`ai_tools_template/${navbar.id}`">{{ navbar.description }}</Link>
                        </div>
                        <div v-else>
                            <p class="title" @click="need_subscription_popup_fun(navbar.premium,navbar.pro,navbar.Free)">{{ navbar.title }}</p>
                            <p class="description" @click="need_subscription_popup_fun(navbar.premium,navbar.pro,navbar.Free)">{{ navbar.description }}</p>
                        </div>
                    </div>
                    <div v-else-if="navbar.Free" class="desc_card">
                        <div>
                            <Link class="title" :href="`ai_tools_template/${navbar.id}`">{{ navbar.title }}</Link>
                            <Link class="description" :href="`ai_tools_template/${navbar.id}`">{{ navbar.description }}</Link>
                        </div>
                    </div>
                    <div v-else>
                        <p class="title" @click="need_subscription_popup_fun(navbar.premium,navbar.pro,navbar.Free)">{{ navbar.title }}</p>
                        <p class="description" @click="need_subscription_popup_fun(navbar.premium,navbar.pro,navbar.Free)">{{ navbar.description }}</p>
                    </div>
                    <div class="plan_level">
                        <p v-if="navbar.premium" class="Premium"><i class="fa-solid fa-gem"></i>Premium</p>
                        <p v-else-if="navbar.pro" class="Pro"><i class="fa-solid fa-crown"></i>Pro</p>
                        <p v-else-if="navbar.Free" class="Free"><i class="fa-solid fa-gift"></i>Free</p>
                    </div>
                </div>
            </div>

            <p class="header_categorie">
                <span class="title">{{ $page.props.auth.AiText.navbar[0][7].name}}</span>
                <span class="description">{{ $page.props.auth.AiText.navbar[0][7].description}}</span>
            </p>
            <div class="cards">
                <div class="card" :class="{'freemCard': navbar.Free, 'proCard': navbar.pro, 'premiumCard': navbar.premium}" v-for="(navbar,index) in $page.props.auth.AiText.undercat8[0]">
                    <div class="card_header">
                        <p v-html="navbar.logo" class="mb-4" :style="{backgroundColor: navbar.color , color: navbar.logo_color}"></p>
                        <div class="star">
                    <label class="container">
                        <input type="checkbox"  @click="addFavorit_text(navbar.id)" :checked="navbar.id === navbar.id_tool">
                        <svg height="24px" id="Layer_1" version="1.2" viewBox="0 0 24 24" width="24px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g><g><path d="M9.362,9.158c0,0-3.16,0.35-5.268,0.584c-0.19,0.023-0.358,0.15-0.421,0.343s0,0.394,0.14,0.521    c1.566,1.429,3.919,3.569,3.919,3.569c-0.002,0-0.646,3.113-1.074,5.19c-0.036,0.188,0.032,0.387,0.196,0.506    c0.163,0.119,0.373,0.121,0.538,0.028c1.844-1.048,4.606-2.624,4.606-2.624s2.763,1.576,4.604,2.625    c0.168,0.092,0.378,0.09,0.541-0.029c0.164-0.119,0.232-0.318,0.195-0.505c-0.428-2.078-1.071-5.191-1.071-5.191    s2.353-2.14,3.919-3.566c0.14-0.131,0.202-0.332,0.14-0.524s-0.23-0.319-0.42-0.341c-2.108-0.236-5.269-0.586-5.269-0.586    s-1.31-2.898-2.183-4.83c-0.082-0.173-0.254-0.294-0.456-0.294s-0.375,0.122-0.453,0.294C10.671,6.26,9.362,9.158,9.362,9.158z"></path></g></g></svg>
                    </label>
                </div>
                    </div>
                    <div v-if="$page.props.auth.user.payment" class="desc_card">
                        <div v-if="$page.props.auth.user.special_user || (navbar.premium && $page.props.auth.user_plan[0].title == 'Premium')">
                            <Link class="title" :href="`ai_tools_template/${navbar.id}`">{{ navbar.title }}</Link>
                            <Link class="description" :href="`ai_tools_template/${navbar.id}`">{{ navbar.description }}</Link>
                        </div>
                        <div v-else-if="$page.props.auth.user.special_user || (navbar.pro && ($page.props.auth.user_plan[0].title == 'Pro' || $page.props.auth.user_plan[0].title == 'Premium'))">
                            <Link class="title" :href="`ai_tools_template/${navbar.id}`">{{ navbar.title }}</Link>
                            <Link class="description" :href="`ai_tools_template/${navbar.id}`">{{ navbar.description }}</Link>
                        </div>
                        <div v-else-if="$page.props.auth.user.special_user || (navbar.Standard && ($page.props.auth.user_plan[0].title == 'Standard' || $page.props.auth.user_plan[0].title == 'Pro' || $page.props.auth.user_plan[0].title == 'Premium'))">
                            <Link class="title" :href="`ai_tools_template/${navbar.id}`">{{ navbar.title }}</Link>
                            <Link class="description" :href="`ai_tools_template/${navbar.id}`">{{ navbar.description }}</Link>
                        </div>
                        <div v-else-if="$page.props.auth.user.special_user || (navbar.Free && ($page.props.auth.user_plan[0].title == 'Standard' || $page.props.auth.user_plan[0].title == 'Pro' || $page.props.auth.user_plan[0].title == 'Premium'))">
                            <Link class="title" :href="`ai_tools_template/${navbar.id}`">{{ navbar.title }}</Link>
                            <Link class="description" :href="`ai_tools_template/${navbar.id}`">{{ navbar.description }}</Link>
                        </div>
                        <div v-else>
                            <p class="title" @click="need_subscription_popup_fun(navbar.premium,navbar.pro,navbar.Free)">{{ navbar.title }}</p>
                            <p class="description" @click="need_subscription_popup_fun(navbar.premium,navbar.pro,navbar.Free)">{{ navbar.description }}</p>
                        </div>
                    </div>
                    <div v-else-if="navbar.Free" class="desc_card">
                        <div>
                            <Link class="title" :href="`ai_tools_template/${navbar.id}`">{{ navbar.title }}</Link>
                            <Link class="description" :href="`ai_tools_template/${navbar.id}`">{{ navbar.description }}</Link>
                        </div>
                    </div>
                    <div v-else>
                        <p class="title" @click="need_subscription_popup_fun(navbar.premium,navbar.pro,navbar.Free)">{{ navbar.title }}</p>
                        <p class="description" @click="need_subscription_popup_fun(navbar.premium,navbar.pro,navbar.Free)">{{ navbar.description }}</p>
                    </div>
                    <div class="plan_level">
                        <p v-if="navbar.premium" class="Premium"><i class="fa-solid fa-gem"></i>Premium</p>
                        <p v-else-if="navbar.pro" class="Pro"><i class="fa-solid fa-crown"></i>Pro</p>
                        <p v-else-if="navbar.Free" class="Free"><i class="fa-solid fa-gift"></i>Free</p>
                    </div>
                </div>
            </div>
        </div>
        <div v-if="page2">
            <div class="cards">
                <div class="card" :class="{'freemCard': navbar.Free, 'proCard': navbar.pro, 'premiumCard': navbar.premium}" v-for="(navbar,index) in $page.props.auth.AiText.undercat1[0]">
                    <div class="card_header">
                        <p v-html="navbar.logo" class="mb-4" :style="{backgroundColor: navbar.color , color: navbar.logo_color}"></p>
                        <div class="star">
                    <label class="container">
                        <input type="checkbox"  @click="addFavorit_text(navbar.id)" :checked="navbar.id === navbar.id_tool">
                        <svg height="24px" id="Layer_1" version="1.2" viewBox="0 0 24 24" width="24px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g><g><path d="M9.362,9.158c0,0-3.16,0.35-5.268,0.584c-0.19,0.023-0.358,0.15-0.421,0.343s0,0.394,0.14,0.521    c1.566,1.429,3.919,3.569,3.919,3.569c-0.002,0-0.646,3.113-1.074,5.19c-0.036,0.188,0.032,0.387,0.196,0.506    c0.163,0.119,0.373,0.121,0.538,0.028c1.844-1.048,4.606-2.624,4.606-2.624s2.763,1.576,4.604,2.625    c0.168,0.092,0.378,0.09,0.541-0.029c0.164-0.119,0.232-0.318,0.195-0.505c-0.428-2.078-1.071-5.191-1.071-5.191    s2.353-2.14,3.919-3.566c0.14-0.131,0.202-0.332,0.14-0.524s-0.23-0.319-0.42-0.341c-2.108-0.236-5.269-0.586-5.269-0.586    s-1.31-2.898-2.183-4.83c-0.082-0.173-0.254-0.294-0.456-0.294s-0.375,0.122-0.453,0.294C10.671,6.26,9.362,9.158,9.362,9.158z"></path></g></g></svg>
                    </label>
                </div>
                    </div>
                    <div v-if="$page.props.auth.user.payment" class="desc_card">
                        <div v-if="$page.props.auth.user.special_user || (navbar.premium && $page.props.auth.user_plan[0].title == 'Premium')">
                            <Link class="title" :href="`ai_tools_template/${navbar.id}`">{{ navbar.title }}</Link>
                            <Link class="description" :href="`ai_tools_template/${navbar.id}`">{{ navbar.description }}</Link>
                        </div>
                        <div v-else-if="$page.props.auth.user.special_user || (navbar.pro && ($page.props.auth.user_plan[0].title == 'Pro' || $page.props.auth.user_plan[0].title == 'Premium'))">
                            <Link class="title" :href="`ai_tools_template/${navbar.id}`">{{ navbar.title }}</Link>
                            <Link class="description" :href="`ai_tools_template/${navbar.id}`">{{ navbar.description }}</Link>
                        </div>
                        <div v-else-if="$page.props.auth.user.special_user || (navbar.Standard && ($page.props.auth.user_plan[0].title == 'Standard' || $page.props.auth.user_plan[0].title == 'Pro' || $page.props.auth.user_plan[0].title == 'Premium'))">
                            <Link class="title" :href="`ai_tools_template/${navbar.id}`">{{ navbar.title }}</Link>
                            <Link class="description" :href="`ai_tools_template/${navbar.id}`">{{ navbar.description }}</Link>
                        </div>
                        <div v-else-if="$page.props.auth.user.special_user || (navbar.Free && ($page.props.auth.user_plan[0].title == 'Standard' || $page.props.auth.user_plan[0].title == 'Pro' || $page.props.auth.user_plan[0].title == 'Premium'))">
                            <Link class="title" :href="`ai_tools_template/${navbar.id}`">{{ navbar.title }}</Link>
                            <Link class="description" :href="`ai_tools_template/${navbar.id}`">{{ navbar.description }}</Link>
                        </div>
                        <div v-else>
                            <p class="title" @click="need_subscription_popup_fun(navbar.premium,navbar.pro,navbar.Free)">{{ navbar.title }}</p>
                            <p class="description" @click="need_subscription_popup_fun(navbar.premium,navbar.pro,navbar.Free)">{{ navbar.description }}</p>
                        </div>
                    </div>
                    <div v-else-if="navbar.Free" class="desc_card">
                        <div>
                            <Link class="title" :href="`ai_tools_template/${navbar.id}`">{{ navbar.title }}</Link>
                            <Link class="description" :href="`ai_tools_template/${navbar.id}`">{{ navbar.description }}</Link>
                        </div>
                    </div>
                    <div v-else>
                        <p class="title" @click="need_subscription_popup_fun(navbar.premium,navbar.pro,navbar.Free)">{{ navbar.title }}</p>
                        <p class="description" @click="need_subscription_popup_fun(navbar.premium,navbar.pro,navbar.Free)">{{ navbar.description }}</p>
                    </div>
                    <div class="plan_level">
                        <p v-if="navbar.premium" class="Premium"><i class="fa-solid fa-gem"></i>Premium</p>
                        <p v-else-if="navbar.pro" class="Pro"><i class="fa-solid fa-crown"></i>Pro</p>
                        <p v-else-if="navbar.Free" class="Free"><i class="fa-solid fa-gift"></i>Free</p>
                    </div>
                </div>
            </div>
        </div>
        <div v-if="page3">
            <div class="cards">
                <div class="card" :class="{'freemCard': navbar.Free, 'proCard': navbar.pro, 'premiumCard': navbar.premium}" v-for="(navbar,index) in $page.props.auth.AiText.undercat2[0]">
                    <div class="card_header">
                        <p v-html="navbar.logo" class="mb-4" :style="{backgroundColor: navbar.color , color: navbar.logo_color}"></p>
                        <div class="star">
                    <label class="container">
                        <input type="checkbox"  @click="addFavorit_text(navbar.id)" :checked="navbar.id === navbar.id_tool">
                        <svg height="24px" id="Layer_1" version="1.2" viewBox="0 0 24 24" width="24px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g><g><path d="M9.362,9.158c0,0-3.16,0.35-5.268,0.584c-0.19,0.023-0.358,0.15-0.421,0.343s0,0.394,0.14,0.521    c1.566,1.429,3.919,3.569,3.919,3.569c-0.002,0-0.646,3.113-1.074,5.19c-0.036,0.188,0.032,0.387,0.196,0.506    c0.163,0.119,0.373,0.121,0.538,0.028c1.844-1.048,4.606-2.624,4.606-2.624s2.763,1.576,4.604,2.625    c0.168,0.092,0.378,0.09,0.541-0.029c0.164-0.119,0.232-0.318,0.195-0.505c-0.428-2.078-1.071-5.191-1.071-5.191    s2.353-2.14,3.919-3.566c0.14-0.131,0.202-0.332,0.14-0.524s-0.23-0.319-0.42-0.341c-2.108-0.236-5.269-0.586-5.269-0.586    s-1.31-2.898-2.183-4.83c-0.082-0.173-0.254-0.294-0.456-0.294s-0.375,0.122-0.453,0.294C10.671,6.26,9.362,9.158,9.362,9.158z"></path></g></g></svg>
                    </label>
                </div>
                    </div>
                    <div v-if="$page.props.auth.user.payment" class="desc_card">
                        <div v-if="$page.props.auth.user.special_user || (navbar.premium && $page.props.auth.user_plan[0].title == 'Premium')">
                            <Link class="title" :href="`ai_tools_template/${navbar.id}`">{{ navbar.title }}</Link>
                            <Link class="description" :href="`ai_tools_template/${navbar.id}`">{{ navbar.description }}</Link>
                        </div>
                        <div v-else-if="$page.props.auth.user.special_user || (navbar.pro && ($page.props.auth.user_plan[0].title == 'Pro' || $page.props.auth.user_plan[0].title == 'Premium'))">
                            <Link class="title" :href="`ai_tools_template/${navbar.id}`">{{ navbar.title }}</Link>
                            <Link class="description" :href="`ai_tools_template/${navbar.id}`">{{ navbar.description }}</Link>
                        </div>
                        <div v-else-if="$page.props.auth.user.special_user || (navbar.Standard && ($page.props.auth.user_plan[0].title == 'Standard' || $page.props.auth.user_plan[0].title == 'Pro' || $page.props.auth.user_plan[0].title == 'Premium'))">
                            <Link class="title" :href="`ai_tools_template/${navbar.id}`">{{ navbar.title }}</Link>
                            <Link class="description" :href="`ai_tools_template/${navbar.id}`">{{ navbar.description }}</Link>
                        </div>
                        <div v-else-if="$page.props.auth.user.special_user || (navbar.Free && ($page.props.auth.user_plan[0].title == 'Standard' || $page.props.auth.user_plan[0].title == 'Pro' || $page.props.auth.user_plan[0].title == 'Premium'))">
                            <Link class="title" :href="`ai_tools_template/${navbar.id}`">{{ navbar.title }}</Link>
                            <Link class="description" :href="`ai_tools_template/${navbar.id}`">{{ navbar.description }}</Link>
                        </div>
                        <div v-else>
                            <p class="title" @click="need_subscription_popup_fun(navbar.premium,navbar.pro,navbar.Free)">{{ navbar.title }}</p>
                            <p class="description" @click="need_subscription_popup_fun(navbar.premium,navbar.pro,navbar.Free)">{{ navbar.description }}</p>
                        </div>
                    </div>
                    <div v-else-if="navbar.Free" class="desc_card">
                        <div>
                            <Link class="title" :href="`ai_tools_template/${navbar.id}`">{{ navbar.title }}</Link>
                            <Link class="description" :href="`ai_tools_template/${navbar.id}`">{{ navbar.description }}</Link>
                        </div>
                    </div>
                    <div v-else>
                        <p class="title" @click="need_subscription_popup_fun(navbar.premium,navbar.pro,navbar.Free)">{{ navbar.title }}</p>
                        <p class="description" @click="need_subscription_popup_fun(navbar.premium,navbar.pro,navbar.Free)">{{ navbar.description }}</p>
                    </div>
                    <div class="plan_level">
                        <p v-if="navbar.premium" class="Premium"><i class="fa-solid fa-gem"></i>Premium</p>
                        <p v-else-if="navbar.pro" class="Pro"><i class="fa-solid fa-crown"></i>Pro</p>
                        <p v-else-if="navbar.Free" class="Free"><i class="fa-solid fa-gift"></i>Free</p>
                    </div>
                </div>
            </div>
        </div>
        <div v-if="page4">
            <div class="cards">
                <div class="card" :class="{'freemCard': navbar.Free, 'proCard': navbar.pro, 'premiumCard': navbar.premium}" v-for="(navbar,index) in $page.props.auth.AiText.undercat3[0]">
                    <div class="card_header">
                        <p v-html="navbar.logo" class="mb-4" :style="{backgroundColor: navbar.color , color: navbar.logo_color}"></p>
                        <div class="star">
                    <label class="container">
                        <input type="checkbox"  @click="addFavorit_text(navbar.id)" :checked="navbar.id === navbar.id_tool">
                        <svg height="24px" id="Layer_1" version="1.2" viewBox="0 0 24 24" width="24px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g><g><path d="M9.362,9.158c0,0-3.16,0.35-5.268,0.584c-0.19,0.023-0.358,0.15-0.421,0.343s0,0.394,0.14,0.521    c1.566,1.429,3.919,3.569,3.919,3.569c-0.002,0-0.646,3.113-1.074,5.19c-0.036,0.188,0.032,0.387,0.196,0.506    c0.163,0.119,0.373,0.121,0.538,0.028c1.844-1.048,4.606-2.624,4.606-2.624s2.763,1.576,4.604,2.625    c0.168,0.092,0.378,0.09,0.541-0.029c0.164-0.119,0.232-0.318,0.195-0.505c-0.428-2.078-1.071-5.191-1.071-5.191    s2.353-2.14,3.919-3.566c0.14-0.131,0.202-0.332,0.14-0.524s-0.23-0.319-0.42-0.341c-2.108-0.236-5.269-0.586-5.269-0.586    s-1.31-2.898-2.183-4.83c-0.082-0.173-0.254-0.294-0.456-0.294s-0.375,0.122-0.453,0.294C10.671,6.26,9.362,9.158,9.362,9.158z"></path></g></g></svg>
                    </label>
                </div>
                    </div>
                    <div v-if="$page.props.auth.user.payment" class="desc_card">
                        <div v-if="$page.props.auth.user.special_user || (navbar.premium && $page.props.auth.user_plan[0].title == 'Premium')">
                            <Link class="title" :href="`ai_tools_template/${navbar.id}`">{{ navbar.title }}</Link>
                            <Link class="description" :href="`ai_tools_template/${navbar.id}`">{{ navbar.description }}</Link>
                        </div>
                        <div v-else-if="$page.props.auth.user.special_user || (navbar.pro && ($page.props.auth.user_plan[0].title == 'Pro' || $page.props.auth.user_plan[0].title == 'Premium'))">
                            <Link class="title" :href="`ai_tools_template/${navbar.id}`">{{ navbar.title }}</Link>
                            <Link class="description" :href="`ai_tools_template/${navbar.id}`">{{ navbar.description }}</Link>
                        </div>
                        <div v-else-if="$page.props.auth.user.special_user || (navbar.Standard && ($page.props.auth.user_plan[0].title == 'Standard' || $page.props.auth.user_plan[0].title == 'Pro' || $page.props.auth.user_plan[0].title == 'Premium'))">
                            <Link class="title" :href="`ai_tools_template/${navbar.id}`">{{ navbar.title }}</Link>
                            <Link class="description" :href="`ai_tools_template/${navbar.id}`">{{ navbar.description }}</Link>
                        </div>
                        <div v-else-if="$page.props.auth.user.special_user || (navbar.Free && ($page.props.auth.user_plan[0].title == 'Standard' || $page.props.auth.user_plan[0].title == 'Pro' || $page.props.auth.user_plan[0].title == 'Premium'))">
                            <Link class="title" :href="`ai_tools_template/${navbar.id}`">{{ navbar.title }}</Link>
                            <Link class="description" :href="`ai_tools_template/${navbar.id}`">{{ navbar.description }}</Link>
                        </div>
                        <div v-else>
                            <p class="title" @click="need_subscription_popup_fun(navbar.premium,navbar.pro,navbar.Free)">{{ navbar.title }}</p>
                            <p class="description" @click="need_subscription_popup_fun(navbar.premium,navbar.pro,navbar.Free)">{{ navbar.description }}</p>
                        </div>
                    </div>
                    <div v-else-if="navbar.Free" class="desc_card">
                        <div>
                            <Link class="title" :href="`ai_tools_template/${navbar.id}`">{{ navbar.title }}</Link>
                            <Link class="description" :href="`ai_tools_template/${navbar.id}`">{{ navbar.description }}</Link>
                        </div>
                    </div>
                    <div v-else>
                        <p class="title" @click="need_subscription_popup_fun(navbar.premium,navbar.pro,navbar.Free)">{{ navbar.title }}</p>
                        <p class="description" @click="need_subscription_popup_fun(navbar.premium,navbar.pro,navbar.Free)">{{ navbar.description }}</p>
                    </div>
                    <div class="plan_level">
                        <p v-if="navbar.premium" class="Premium"><i class="fa-solid fa-gem"></i>Premium</p>
                        <p v-else-if="navbar.pro" class="Pro"><i class="fa-solid fa-crown"></i>Pro</p>
                        <p v-else-if="navbar.Free" class="Free"><i class="fa-solid fa-gift"></i>Free</p>
                    </div>
                </div>
            </div>
        </div>
        <div v-if="page5">
            <div class="cards">
                <div class="card" :class="{'freemCard': navbar.Free, 'proCard': navbar.pro, 'premiumCard': navbar.premium}" v-for="(navbar,index) in $page.props.auth.AiText.undercat4[0]">
                    <div class="card_header">
                        <p v-html="navbar.logo" class="mb-4" :style="{backgroundColor: navbar.color , color: navbar.logo_color}"></p>
                        <div class="star">
                    <label class="container">
                        <input type="checkbox"  @click="addFavorit_text(navbar.id)" :checked="navbar.id === navbar.id_tool">
                        <svg height="24px" id="Layer_1" version="1.2" viewBox="0 0 24 24" width="24px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g><g><path d="M9.362,9.158c0,0-3.16,0.35-5.268,0.584c-0.19,0.023-0.358,0.15-0.421,0.343s0,0.394,0.14,0.521    c1.566,1.429,3.919,3.569,3.919,3.569c-0.002,0-0.646,3.113-1.074,5.19c-0.036,0.188,0.032,0.387,0.196,0.506    c0.163,0.119,0.373,0.121,0.538,0.028c1.844-1.048,4.606-2.624,4.606-2.624s2.763,1.576,4.604,2.625    c0.168,0.092,0.378,0.09,0.541-0.029c0.164-0.119,0.232-0.318,0.195-0.505c-0.428-2.078-1.071-5.191-1.071-5.191    s2.353-2.14,3.919-3.566c0.14-0.131,0.202-0.332,0.14-0.524s-0.23-0.319-0.42-0.341c-2.108-0.236-5.269-0.586-5.269-0.586    s-1.31-2.898-2.183-4.83c-0.082-0.173-0.254-0.294-0.456-0.294s-0.375,0.122-0.453,0.294C10.671,6.26,9.362,9.158,9.362,9.158z"></path></g></g></svg>
                    </label>
                </div>
                    </div>
                    <div v-if="$page.props.auth.user.payment" class="desc_card">
                        <div v-if="$page.props.auth.user.special_user || (navbar.premium && $page.props.auth.user_plan[0].title == 'Premium')">
                            <Link class="title" :href="`ai_tools_template/${navbar.id}`">{{ navbar.title }}</Link>
                            <Link class="description" :href="`ai_tools_template/${navbar.id}`">{{ navbar.description }}</Link>
                        </div>
                        <div v-else-if="$page.props.auth.user.special_user || (navbar.pro && ($page.props.auth.user_plan[0].title == 'Pro' || $page.props.auth.user_plan[0].title == 'Premium'))">
                            <Link class="title" :href="`ai_tools_template/${navbar.id}`">{{ navbar.title }}</Link>
                            <Link class="description" :href="`ai_tools_template/${navbar.id}`">{{ navbar.description }}</Link>
                        </div>
                        <div v-else-if="$page.props.auth.user.special_user || (navbar.Standard && ($page.props.auth.user_plan[0].title == 'Standard' || $page.props.auth.user_plan[0].title == 'Pro' || $page.props.auth.user_plan[0].title == 'Premium'))">
                            <Link class="title" :href="`ai_tools_template/${navbar.id}`">{{ navbar.title }}</Link>
                            <Link class="description" :href="`ai_tools_template/${navbar.id}`">{{ navbar.description }}</Link>
                        </div>
                        <div v-else-if="$page.props.auth.user.special_user || (navbar.Free && ($page.props.auth.user_plan[0].title == 'Standard' || $page.props.auth.user_plan[0].title == 'Pro' || $page.props.auth.user_plan[0].title == 'Premium'))">
                            <Link class="title" :href="`ai_tools_template/${navbar.id}`">{{ navbar.title }}</Link>
                            <Link class="description" :href="`ai_tools_template/${navbar.id}`">{{ navbar.description }}</Link>
                        </div>
                        <div v-else>
                            <p class="title" @click="need_subscription_popup_fun(navbar.premium,navbar.pro,navbar.Free)">{{ navbar.title }}</p>
                            <p class="description" @click="need_subscription_popup_fun(navbar.premium,navbar.pro,navbar.Free)">{{ navbar.description }}</p>
                        </div>
                    </div>
                    <div v-else-if="navbar.Free" class="desc_card">
                        <div>
                            <Link class="title" :href="`ai_tools_template/${navbar.id}`">{{ navbar.title }}</Link>
                            <Link class="description" :href="`ai_tools_template/${navbar.id}`">{{ navbar.description }}</Link>
                        </div>
                    </div>
                    <div v-else>
                        <p class="title" @click="need_subscription_popup_fun(navbar.premium,navbar.pro,navbar.Free)">{{ navbar.title }}</p>
                        <p class="description" @click="need_subscription_popup_fun(navbar.premium,navbar.pro,navbar.Free)">{{ navbar.description }}</p>
                    </div>
                    <div class="plan_level">
                        <p v-if="navbar.premium" class="Premium"><i class="fa-solid fa-gem"></i>Premium</p>
                        <p v-else-if="navbar.pro" class="Pro"><i class="fa-solid fa-crown"></i>Pro</p>
                        <p v-else-if="navbar.Free" class="Free"><i class="fa-solid fa-gift"></i>Free</p>
                    </div>
                </div>
            </div>
        </div>
        <div v-if="page6">
            <div class="cards">
                <div class="card" :class="{'freemCard': navbar.Free, 'proCard': navbar.pro, 'premiumCard': navbar.premium}" v-for="(navbar,index) in $page.props.auth.AiText.undercat5[0]">
                    <div class="card_header">
                        <p v-html="navbar.logo" class="mb-4" :style="{backgroundColor: navbar.color , color: navbar.logo_color}"></p>
                        <div class="star">
                    <label class="container">
                        <input type="checkbox"  @click="addFavorit_text(navbar.id)" :checked="navbar.id === navbar.id_tool">
                        <svg height="24px" id="Layer_1" version="1.2" viewBox="0 0 24 24" width="24px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g><g><path d="M9.362,9.158c0,0-3.16,0.35-5.268,0.584c-0.19,0.023-0.358,0.15-0.421,0.343s0,0.394,0.14,0.521    c1.566,1.429,3.919,3.569,3.919,3.569c-0.002,0-0.646,3.113-1.074,5.19c-0.036,0.188,0.032,0.387,0.196,0.506    c0.163,0.119,0.373,0.121,0.538,0.028c1.844-1.048,4.606-2.624,4.606-2.624s2.763,1.576,4.604,2.625    c0.168,0.092,0.378,0.09,0.541-0.029c0.164-0.119,0.232-0.318,0.195-0.505c-0.428-2.078-1.071-5.191-1.071-5.191    s2.353-2.14,3.919-3.566c0.14-0.131,0.202-0.332,0.14-0.524s-0.23-0.319-0.42-0.341c-2.108-0.236-5.269-0.586-5.269-0.586    s-1.31-2.898-2.183-4.83c-0.082-0.173-0.254-0.294-0.456-0.294s-0.375,0.122-0.453,0.294C10.671,6.26,9.362,9.158,9.362,9.158z"></path></g></g></svg>
                    </label>
                </div>
                    </div>
                    <div v-if="$page.props.auth.user.payment" class="desc_card">
                        <div v-if="$page.props.auth.user.special_user || (navbar.premium && $page.props.auth.user_plan[0].title == 'Premium')">
                            <Link class="title" :href="`ai_tools_template/${navbar.id}`">{{ navbar.title }}</Link>
                            <Link class="description" :href="`ai_tools_template/${navbar.id}`">{{ navbar.description }}</Link>
                        </div>
                        <div v-else-if="$page.props.auth.user.special_user || (navbar.pro && ($page.props.auth.user_plan[0].title == 'Pro' || $page.props.auth.user_plan[0].title == 'Premium'))">
                            <Link class="title" :href="`ai_tools_template/${navbar.id}`">{{ navbar.title }}</Link>
                            <Link class="description" :href="`ai_tools_template/${navbar.id}`">{{ navbar.description }}</Link>
                        </div>
                        <div v-else-if="$page.props.auth.user.special_user || (navbar.Standard && ($page.props.auth.user_plan[0].title == 'Standard' || $page.props.auth.user_plan[0].title == 'Pro' || $page.props.auth.user_plan[0].title == 'Premium'))">
                            <Link class="title" :href="`ai_tools_template/${navbar.id}`">{{ navbar.title }}</Link>
                            <Link class="description" :href="`ai_tools_template/${navbar.id}`">{{ navbar.description }}</Link>
                        </div>
                        <div v-else-if="$page.props.auth.user.special_user || (navbar.Free && ($page.props.auth.user_plan[0].title == 'Standard' || $page.props.auth.user_plan[0].title == 'Pro' || $page.props.auth.user_plan[0].title == 'Premium'))">
                            <Link class="title" :href="`ai_tools_template/${navbar.id}`">{{ navbar.title }}</Link>
                            <Link class="description" :href="`ai_tools_template/${navbar.id}`">{{ navbar.description }}</Link>
                        </div>
                        <div v-else>
                            <p class="title" @click="need_subscription_popup_fun(navbar.premium,navbar.pro,navbar.Free)">{{ navbar.title }}</p>
                            <p class="description" @click="need_subscription_popup_fun(navbar.premium,navbar.pro,navbar.Free)">{{ navbar.description }}</p>
                        </div>
                    </div>
                    <div v-else-if="navbar.Free" class="desc_card">
                        <div>
                            <Link class="title" :href="`ai_tools_template/${navbar.id}`">{{ navbar.title }}</Link>
                            <Link class="description" :href="`ai_tools_template/${navbar.id}`">{{ navbar.description }}</Link>
                        </div>
                    </div>
                    <div v-else>
                        <p class="title" @click="need_subscription_popup_fun(navbar.premium,navbar.pro,navbar.Free)">{{ navbar.title }}</p>
                        <p class="description" @click="need_subscription_popup_fun(navbar.premium,navbar.pro,navbar.Free)">{{ navbar.description }}</p>
                    </div>
                    <div class="plan_level">
                        <p v-if="navbar.premium" class="Premium"><i class="fa-solid fa-gem"></i>Premium</p>
                        <p v-else-if="navbar.pro" class="Pro"><i class="fa-solid fa-crown"></i>Pro</p>
                        <p v-else-if="navbar.Free" class="Free"><i class="fa-solid fa-gift"></i>Free</p>
                    </div>
                </div>
            </div>
        </div>
        <div v-if="page7">
            <div class="cards">
                <div class="card" :class="{'freemCard': navbar.Free, 'proCard': navbar.pro, 'premiumCard': navbar.premium}" v-for="(navbar,index) in $page.props.auth.AiText.undercat6[0]">
                    <div class="card_header">
                        <p v-html="navbar.logo" class="mb-4" :style="{backgroundColor: navbar.color , color: navbar.logo_color}"></p>
                        <div class="star">
                    <label class="container">
                        <input type="checkbox"  @click="addFavorit_text(navbar.id)" :checked="navbar.id === navbar.id_tool">
                        <svg height="24px" id="Layer_1" version="1.2" viewBox="0 0 24 24" width="24px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g><g><path d="M9.362,9.158c0,0-3.16,0.35-5.268,0.584c-0.19,0.023-0.358,0.15-0.421,0.343s0,0.394,0.14,0.521    c1.566,1.429,3.919,3.569,3.919,3.569c-0.002,0-0.646,3.113-1.074,5.19c-0.036,0.188,0.032,0.387,0.196,0.506    c0.163,0.119,0.373,0.121,0.538,0.028c1.844-1.048,4.606-2.624,4.606-2.624s2.763,1.576,4.604,2.625    c0.168,0.092,0.378,0.09,0.541-0.029c0.164-0.119,0.232-0.318,0.195-0.505c-0.428-2.078-1.071-5.191-1.071-5.191    s2.353-2.14,3.919-3.566c0.14-0.131,0.202-0.332,0.14-0.524s-0.23-0.319-0.42-0.341c-2.108-0.236-5.269-0.586-5.269-0.586    s-1.31-2.898-2.183-4.83c-0.082-0.173-0.254-0.294-0.456-0.294s-0.375,0.122-0.453,0.294C10.671,6.26,9.362,9.158,9.362,9.158z"></path></g></g></svg>
                    </label>
                </div>
                    </div>
                    <div v-if="$page.props.auth.user.payment" class="desc_card">
                        <div v-if="$page.props.auth.user.special_user || (navbar.premium && $page.props.auth.user_plan[0].title == 'Premium')">
                            <Link class="title" :href="`ai_tools_template/${navbar.id}`">{{ navbar.title }}</Link>
                            <Link class="description" :href="`ai_tools_template/${navbar.id}`">{{ navbar.description }}</Link>
                        </div>
                        <div v-else-if="$page.props.auth.user.special_user || (navbar.pro && ($page.props.auth.user_plan[0].title == 'Pro' || $page.props.auth.user_plan[0].title == 'Premium'))">
                            <Link class="title" :href="`ai_tools_template/${navbar.id}`">{{ navbar.title }}</Link>
                            <Link class="description" :href="`ai_tools_template/${navbar.id}`">{{ navbar.description }}</Link>
                        </div>
                        <div v-else-if="$page.props.auth.user.special_user || (navbar.Standard && ($page.props.auth.user_plan[0].title == 'Standard' || $page.props.auth.user_plan[0].title == 'Pro' || $page.props.auth.user_plan[0].title == 'Premium'))">
                            <Link class="title" :href="`ai_tools_template/${navbar.id}`">{{ navbar.title }}</Link>
                            <Link class="description" :href="`ai_tools_template/${navbar.id}`">{{ navbar.description }}</Link>
                        </div>
                        <div v-else>
                            <p class="title" @click="need_subscription_popup_fun(navbar.premium,navbar.pro,navbar.Free)">{{ navbar.title }}</p>
                            <p class="description" @click="need_subscription_popup_fun(navbar.premium,navbar.pro,navbar.Free)">{{ navbar.description }}</p>
                        </div>
                    </div>
                    <div v-else-if="navbar.Free" class="desc_card">
                        <div>
                            <Link class="title" :href="`ai_tools_template/${navbar.id}`">{{ navbar.title }}</Link>
                            <Link class="description" :href="`ai_tools_template/${navbar.id}`">{{ navbar.description }}</Link>
                        </div>
                    </div>
                    <div v-else>
                        <p class="title" @click="need_subscription_popup_fun(navbar.premium,navbar.pro,navbar.Free)">{{ navbar.title }}</p>
                        <p class="description" @click="need_subscription_popup_fun(navbar.premium,navbar.pro,navbar.Free)">{{ navbar.description }}</p>
                    </div>
                    <div class="plan_level">
                        <p v-if="navbar.premium" class="Premium"><i class="fa-solid fa-gem"></i>Premium</p>
                        <p v-else-if="navbar.pro" class="Pro"><i class="fa-solid fa-crown"></i>Pro</p>
                        <p v-else-if="navbar.Free" class="Free"><i class="fa-solid fa-gift"></i>Free</p>
                    </div>
                </div>
            </div>
        </div>
        <div v-if="page8">
            <div class="cards">
                <div class="card" :class="{'freemCard': navbar.Free, 'proCard': navbar.pro, 'premiumCard': navbar.premium}" v-for="(navbar,index) in $page.props.auth.AiText.undercat7[0]">
                    <div class="card_header">
                        <p v-html="navbar.logo" class="mb-4" :style="{backgroundColor: navbar.color , color: navbar.logo_color}"></p>
                        <div class="star">
                    <label class="container">
                        <input type="checkbox"  @click="addFavorit_text(navbar.id)" :checked="navbar.id === navbar.id_tool">
                        <svg height="24px" id="Layer_1" version="1.2" viewBox="0 0 24 24" width="24px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g><g><path d="M9.362,9.158c0,0-3.16,0.35-5.268,0.584c-0.19,0.023-0.358,0.15-0.421,0.343s0,0.394,0.14,0.521    c1.566,1.429,3.919,3.569,3.919,3.569c-0.002,0-0.646,3.113-1.074,5.19c-0.036,0.188,0.032,0.387,0.196,0.506    c0.163,0.119,0.373,0.121,0.538,0.028c1.844-1.048,4.606-2.624,4.606-2.624s2.763,1.576,4.604,2.625    c0.168,0.092,0.378,0.09,0.541-0.029c0.164-0.119,0.232-0.318,0.195-0.505c-0.428-2.078-1.071-5.191-1.071-5.191    s2.353-2.14,3.919-3.566c0.14-0.131,0.202-0.332,0.14-0.524s-0.23-0.319-0.42-0.341c-2.108-0.236-5.269-0.586-5.269-0.586    s-1.31-2.898-2.183-4.83c-0.082-0.173-0.254-0.294-0.456-0.294s-0.375,0.122-0.453,0.294C10.671,6.26,9.362,9.158,9.362,9.158z"></path></g></g></svg>
                    </label>
                </div>
                    </div>
                    <div v-if="$page.props.auth.user.payment" class="desc_card">
                        <div v-if="$page.props.auth.user.special_user || (navbar.premium && $page.props.auth.user_plan[0].title == 'Premium')">
                            <Link class="title" :href="`ai_tools_template/${navbar.id}`">{{ navbar.title }}</Link>
                            <Link class="description" :href="`ai_tools_template/${navbar.id}`">{{ navbar.description }}</Link>
                        </div>
                        <div v-else-if="$page.props.auth.user.special_user || (navbar.pro && ($page.props.auth.user_plan[0].title == 'Pro' || $page.props.auth.user_plan[0].title == 'Premium'))">
                            <Link class="title" :href="`ai_tools_template/${navbar.id}`">{{ navbar.title }}</Link>
                            <Link class="description" :href="`ai_tools_template/${navbar.id}`">{{ navbar.description }}</Link>
                        </div>
                        <div v-else-if="$page.props.auth.user.special_user || (navbar.Standard && ($page.props.auth.user_plan[0].title == 'Standard' || $page.props.auth.user_plan[0].title == 'Pro' || $page.props.auth.user_plan[0].title == 'Premium'))">
                            <Link class="title" :href="`ai_tools_template/${navbar.id}`">{{ navbar.title }}</Link>
                            <Link class="description" :href="`ai_tools_template/${navbar.id}`">{{ navbar.description }}</Link>
                        </div>
                        <div v-else-if="$page.props.auth.user.special_user || (navbar.Free && ($page.props.auth.user_plan[0].title == 'Standard' || $page.props.auth.user_plan[0].title == 'Pro' || $page.props.auth.user_plan[0].title == 'Premium'))">
                            <Link class="title" :href="`ai_tools_template/${navbar.id}`">{{ navbar.title }}</Link>
                            <Link class="description" :href="`ai_tools_template/${navbar.id}`">{{ navbar.description }}</Link>
                        </div>
                        <div v-else>
                            <p class="title" @click="need_subscription_popup_fun(navbar.premium,navbar.pro,navbar.Free)">{{ navbar.title }}</p>
                            <p class="description" @click="need_subscription_popup_fun(navbar.premium,navbar.pro,navbar.Free)">{{ navbar.description }}</p>
                        </div>
                    </div>
                    <div v-else-if="navbar.Free" class="desc_card">
                        <div>
                            <Link class="title" :href="`ai_tools_template/${navbar.id}`">{{ navbar.title }}</Link>
                            <Link class="description" :href="`ai_tools_template/${navbar.id}`">{{ navbar.description }}</Link>
                        </div>
                    </div>
                    <div v-else>
                        <p class="title" @click="need_subscription_popup_fun(navbar.premium,navbar.pro,navbar.Free)">{{ navbar.title }}</p>
                        <p class="description" @click="need_subscription_popup_fun(navbar.premium,navbar.pro,navbar.Free)">{{ navbar.description }}</p>
                    </div>
                    <div class="plan_level">
                        <p v-if="navbar.premium" class="Premium"><i class="fa-solid fa-gem"></i>Premium</p>
                        <p v-else-if="navbar.pro" class="Pro"><i class="fa-solid fa-crown"></i>Pro</p>
                        <p v-else-if="navbar.Free" class="Free"><i class="fa-solid fa-gift"></i>Free</p>
                    </div>
                </div>
            </div>
        </div>
        <div v-if="page9">
            <div class="cards">
                <div class="card" :class="{'freemCard': navbar.Free, 'proCard': navbar.pro, 'premiumCard': navbar.premium}" v-for="(navbar,index) in $page.props.auth.AiText.undercat8[0]">
                    <div class="card_header">
                        <p v-html="navbar.logo" class="mb-4" :style="{backgroundColor: navbar.color , color: navbar.logo_color}"></p>
                        <div class="star">
                    <label class="container">
                        <input type="checkbox"  @click="addFavorit_text(navbar.id)" :checked="navbar.id === navbar.id_sub_tool">
                        <svg height="24px" id="Layer_1" version="1.2" viewBox="0 0 24 24" width="24px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g><g><path d="M9.362,9.158c0,0-3.16,0.35-5.268,0.584c-0.19,0.023-0.358,0.15-0.421,0.343s0,0.394,0.14,0.521    c1.566,1.429,3.919,3.569,3.919,3.569c-0.002,0-0.646,3.113-1.074,5.19c-0.036,0.188,0.032,0.387,0.196,0.506    c0.163,0.119,0.373,0.121,0.538,0.028c1.844-1.048,4.606-2.624,4.606-2.624s2.763,1.576,4.604,2.625    c0.168,0.092,0.378,0.09,0.541-0.029c0.164-0.119,0.232-0.318,0.195-0.505c-0.428-2.078-1.071-5.191-1.071-5.191    s2.353-2.14,3.919-3.566c0.14-0.131,0.202-0.332,0.14-0.524s-0.23-0.319-0.42-0.341c-2.108-0.236-5.269-0.586-5.269-0.586    s-1.31-2.898-2.183-4.83c-0.082-0.173-0.254-0.294-0.456-0.294s-0.375,0.122-0.453,0.294C10.671,6.26,9.362,9.158,9.362,9.158z"></path></g></g></svg>
                    </label>
                </div>
                    </div>
                    <div v-if="$page.props.auth.user.payment" class="desc_card">
                        <div v-if="$page.props.auth.user.special_user || (navbar.premium && $page.props.auth.user_plan[0].title == 'Premium')">
                            <Link class="title" :href="`ai_tools_template/${navbar.id}`">{{ navbar.title }}</Link>
                            <Link class="description" :href="`ai_tools_template/${navbar.id}`">{{ navbar.description }}</Link>
                        </div>
                        <div v-else-if="$page.props.auth.user.special_user || (navbar.pro && ($page.props.auth.user_plan[0].title == 'Pro' || $page.props.auth.user_plan[0].title == 'Premium'))">
                            <Link class="title" :href="`ai_tools_template/${navbar.id}`">{{ navbar.title }}</Link>
                            <Link class="description" :href="`ai_tools_template/${navbar.id}`">{{ navbar.description }}</Link>
                        </div>
                        <div v-else-if="$page.props.auth.user.special_user || (navbar.Standard && ($page.props.auth.user_plan[0].title == 'Standard' || $page.props.auth.user_plan[0].title == 'Pro' || $page.props.auth.user_plan[0].title == 'Premium'))">
                            <Link class="title" :href="`ai_tools_template/${navbar.id}`">{{ navbar.title }}</Link>
                            <Link class="description" :href="`ai_tools_template/${navbar.id}`">{{ navbar.description }}</Link>
                        </div>
                        <div v-else-if="$page.props.auth.user.special_user || (navbar.Free && ($page.props.auth.user_plan[0].title == 'Standard' || $page.props.auth.user_plan[0].title == 'Pro' || $page.props.auth.user_plan[0].title == 'Premium'))">
                            <Link class="title" :href="`ai_tools_template/${navbar.id}`">{{ navbar.title }}</Link>
                            <Link class="description" :href="`ai_tools_template/${navbar.id}`">{{ navbar.description }}</Link>
                        </div>
                        <div v-else>
                            <p class="title" @click="need_subscription_popup_fun(navbar.premium,navbar.pro,navbar.Free)">{{ navbar.title }}</p>
                            <p class="description" @click="need_subscription_popup_fun(navbar.premium,navbar.pro,navbar.Free)">{{ navbar.description }}</p>
                        </div>
                    </div>
                    <div v-else-if="navbar.Free" class="desc_card">
                        <div>
                            <Link class="title" :href="`ai_tools_template/${navbar.id}`">{{ navbar.title }}</Link>
                            <Link class="description" :href="`ai_tools_template/${navbar.id}`">{{ navbar.description }}</Link>
                        </div>
                    </div>
                    <div v-else>
                        <p class="title" @click="need_subscription_popup_fun(navbar.premium,navbar.pro,navbar.Free)">{{ navbar.title }}</p>
                        <p class="description" @click="need_subscription_popup_fun(navbar.premium,navbar.pro,navbar.Free)">{{ navbar.description }}</p>
                    </div>
                    <div class="plan_level">
                        <p v-if="navbar.premium" class="Premium"><i class="fa-solid fa-gem"></i>Premium</p>
                        <p v-else-if="navbar.pro" class="Pro"><i class="fa-solid fa-crown"></i>Pro</p>
                        <p v-else-if="navbar.Free" class="Free"><i class="fa-solid fa-gift"></i>Free</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="popup_favorit_add" v-if="need_subscription_popup">
    <div class="notificationCard">
        <i class="fa-solid fa-xmark"></i>
        <p class="notificationHeading">You Need <span>{{ subs_level }}</span> Subscription to open this Tool</p>
        <div class="buttonContainer">
            <button class="AllowBtn" @click="need_subscription_popup_fun()">OK</button>
        </div>
    </div>
</div>
</template>
<script setup>
import { Head , Link } from '@inertiajs/vue3';
</script>

<script>
export default {
    name: 'App',
    components: {
        Head,
        Link,
    },
    props: {

    },

    data() {
        return {
            page1:true,
            page2:false,
            page3:false,
            page4:false,
            page5:false,
            page6:false,
            page7:false,
            page8:false,
            page9:false,

            need_subscription_popup:false,
            subs_level: null,
        }
    },
    mounted() {

    },
    methods: {
        pagination_text(index){
            switch (index) {
                case 0:this.page1=true;this.page2=false;this.page3=false;this.page4=false;this.page5=false;this.page6=false;this.page7=false;this.page8=false;this.page9=false;break;
                case 1:this.page1=false;this.page2=true;this.page3=false;this.page4=false;this.page5=false;this.page6=false;this.page7=false;this.page8=false;this.page9=false;break;
                case 2:this.page1=false;this.page2=false;this.page3=true;this.page4=false;this.page5=false;this.page6=false;this.page7=false;this.page8=false;this.page9=false;break;
                case 3:this.page1=false;this.page2=false;this.page3=false;this.page4=true;this.page5=false;this.page6=false;this.page7=false;this.page8=false;this.page9=false;break;
                case 4:this.page1=false;this.page2=false;this.page3=false;this.page4=false;this.page5=true;this.page6=false;this.page7=false;this.page8=false;this.page9=false;break;
                case 5:this.page1=false;this.page2=false;this.page3=false;this.page4=false;this.page5=false;this.page6=true;this.page7=false;this.page8=false;this.page9=false;break;
                case 6:this.page1=false;this.page2=false;this.page3=false;this.page4=false;this.page5=false;this.page6=false;this.page7=true;this.page8=false;this.page9=false;break;
                case 7:this.page1=false;this.page2=false;this.page3=false;this.page4=false;this.page5=false;this.page6=false;this.page7=false;this.page8=true;this.page9=false;break;
                case 8:this.page1=false;this.page2=false;this.page3=false;this.page4=false;this.page5=false;this.page6=false;this.page7=false;this.page8=false;this.page9=true;break;
            }
        },
        need_subscription_popup_fun(prum,pro,free){
            if(this.need_subscription_popup)
                this.need_subscription_popup = false
            else{
                if(prum)
                    this.subs_level = 'Premium';
                else if(pro)
                    this.subs_level = 'Pro';
                else
                    this.subs_level = 'Standard';

               this.need_subscription_popup = true;
            }
        },
        addFavorit_text(tool_id) {
            this.$inertia.post(`ai_tools_list/${tool_id}/add_favorit`);
        },
    },
}
</script>