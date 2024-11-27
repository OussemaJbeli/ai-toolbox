<template>
    <Head title="AI-Tool" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight page_title">
                <i class="fa-solid fa-star"></i>
                /AI-Document Chat</h2>
        </template>
        <div class="chat_tools_template">
            <div class="first_part" :style="{left: open_convertation? '0px':'-310px'}">
                <div class="close_open">
                    <i class="fa-solid fa-xmark" @click="open_close()" v-if="open_convertation"></i>
                    <i class="fa-solid fa-bars-staggered" @click="open_close()" v-else></i>
                </div>
                <input 
                    class="search" type="search" 
                    v-model="searchQuery" 
                    placeholder="search ..." 
                />
                <div class="cards">
                    <div class="words_balence" v-if="$page.props.auth.user.special_user">
                        Your Balance <span v-if="countToken">{{countToken}}</span><span v-else>0</span> / Unlimited
                    </div>
                    <div class="words_balence" v-else-if="$page.props.auth.user.payment">
                        Your Balance <span v-if="countToken">{{countToken}}</span><span v-else>0</span> / {{ curentToken }}
                    </div>
                    <div class="words_balence" v-else>
                        Your Balance <span v-if="countToken">{{countToken}}</span><span v-else>0</span> / {{ curentToken }}
                    </div>
                    <div class="card" v-for="conversation in filtereditms" :class="conversation.id == current_conversation.id? 'selected_card':''">
                        <div>
                            <Link class="title" :href="`/tools_Conversation/${pages.id}/${conversation.id}/nextPage`">{{conversation.title}}</Link>
                            <div class="buttons">
                                <div  @click="openConvedit(conversation.id,conversation.title)" class="title" :href="`/tools_Conversation/${pages.id}/${conversation.id}/nextPage`"><i class="fa-solid fa-pen-to-square"></i></div>
                                <Link v-if="conversation.id == current_conversation.id" class="title" :href="`/tools_Conversation/${conversation.id}/${pages.id}/destroy`"><i class="fa-solid fa-trash"></i></Link>
                                <Link v-else class="title" :href="`/tools_Conversation/${conversation.id}/refresh/destroy`"><i class="fa-solid fa-trash"></i></Link>
                            </div>
                        </div>
                        <Link class="description" :href="`/tools_Conversation/${pages.id}/${conversation.id}/nextPage`">
                            <div class="meg_num">{{ conversation.tools_conversation_count }}<span> message</span></div>
                            <div class="date">{{conversation.formatted_created_at}}</div>
                        </Link>
                        <a class="file_path" :href="`/${conversation.doc_path}`" target="_blank">
                            <p>{{conversation.doc_name}}</p>
                        </a>
                    </div>
                </div>
                <div class="add_new_conversation">
                    <div class="button" @click="openConv">
                        <div class="sp">
                            <button class="sparkle-button">
                            <span class="spark"></span>
                            
                            <span class="backdrop"></span>
                            <svg class="sparkle" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M14.187 8.096L15 5.25L15.813 8.096C16.0231 8.83114 16.4171 9.50062 16.9577 10.0413C17.4984 10.5819 18.1679 10.9759 18.903 11.186L21.75 12L18.904 12.813C18.1689 13.0231 17.4994 13.4171 16.9587 13.9577C16.4181 14.4984 16.0241 15.1679 15.814 15.903L15 18.75L14.187 15.904C13.9769 15.1689 13.5829 14.4994 13.0423 13.9587C12.5016 13.4181 11.8321 13.0241 11.097 12.814L8.25 12L11.096 11.187C11.8311 10.9769 12.5006 10.5829 13.0413 10.0423C13.5819 9.50162 13.9759 8.83214 14.186 8.097L14.187 8.096Z" fill="black" stroke="black" stroke-linecap="round" stroke-linejoin="round"></path>
                                <path d="M6 14.25L5.741 15.285C5.59267 15.8785 5.28579 16.4206 4.85319 16.8532C4.42059 17.2858 3.87853 17.5927 3.285 17.741L2.25 18L3.285 18.259C3.87853 18.4073 4.42059 18.7142 4.85319 19.1468C5.28579 19.5794 5.59267 20.1215 5.741 20.715L6 21.75L6.259 20.715C6.40725 20.1216 6.71398 19.5796 7.14639 19.147C7.5788 18.7144 8.12065 18.4075 8.714 18.259L9.75 18L8.714 17.741C8.12065 17.5925 7.5788 17.2856 7.14639 16.853C6.71398 16.4204 6.40725 15.8784 6.259 15.285L6 14.25Z" fill="black" stroke="black" stroke-linecap="round" stroke-linejoin="round"></path>
                                <path d="M6.5 4L6.303 4.5915C6.24777 4.75718 6.15472 4.90774 6.03123 5.03123C5.90774 5.15472 5.75718 5.24777 5.5915 5.303L5 5.5L5.5915 5.697C5.75718 5.75223 5.90774 5.84528 6.03123 5.96877C6.15472 6.09226 6.24777 6.24282 6.303 6.4085L6.5 7L6.697 6.4085C6.75223 6.24282 6.84528 6.09226 6.96877 5.96877C7.09226 5.84528 7.24282 5.75223 7.4085 5.697L8 5.5L7.4085 5.303C7.24282 5.24777 7.09226 5.15472 6.96877 5.03123C6.84528 4.90774 6.75223 4.75718 6.697 4.5915L6.5 4Z" fill="black" stroke="black" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                            <span class="text">Add New Conversation</span>
                            </button>
                            <div class="bodydrop"></div>
                            <span aria-hidden="true" class="particle-pen">
                            <svg class="particle" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M6.937 3.846L7.75 1L8.563 3.846C8.77313 4.58114 9.1671 5.25062 9.70774 5.79126C10.2484 6.3319 10.9179 6.72587 11.653 6.936L14.5 7.75L11.654 8.563C10.9189 8.77313 10.2494 9.1671 9.70874 9.70774C9.1681 10.2484 8.77413 10.9179 8.564 11.653L7.75 14.5L6.937 11.654C6.72687 10.9189 6.3329 10.2494 5.79226 9.70874C5.25162 9.1681 4.58214 8.77413 3.847 8.564L1 7.75L3.846 6.937C4.58114 6.72687 5.25062 6.3329 5.79126 5.79226C6.3319 5.25162 6.72587 4.58214 6.936 3.847L6.937 3.846Z" fill="black" stroke="black" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                            <svg class="particle" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M6.937 3.846L7.75 1L8.563 3.846C8.77313 4.58114 9.1671 5.25062 9.70774 5.79126C10.2484 6.3319 10.9179 6.72587 11.653 6.936L14.5 7.75L11.654 8.563C10.9189 8.77313 10.2494 9.1671 9.70874 9.70774C9.1681 10.2484 8.77413 10.9179 8.564 11.653L7.75 14.5L6.937 11.654C6.72687 10.9189 6.3329 10.2494 5.79226 9.70874C5.25162 9.1681 4.58214 8.77413 3.847 8.564L1 7.75L3.846 6.937C4.58114 6.72687 5.25062 6.3329 5.79126 5.79226C6.3319 5.25162 6.72587 4.58214 6.936 3.847L6.937 3.846Z" fill="black" stroke="black" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                            <svg class="particle" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M6.937 3.846L7.75 1L8.563 3.846C8.77313 4.58114 9.1671 5.25062 9.70774 5.79126C10.2484 6.3319 10.9179 6.72587 11.653 6.936L14.5 7.75L11.654 8.563C10.9189 8.77313 10.2494 9.1671 9.70874 9.70774C9.1681 10.2484 8.77413 10.9179 8.564 11.653L7.75 14.5L6.937 11.654C6.72687 10.9189 6.3329 10.2494 5.79226 9.70874C5.25162 9.1681 4.58214 8.77413 3.847 8.564L1 7.75L3.846 6.937C4.58114 6.72687 5.25062 6.3329 5.79126 5.79226C6.3319 5.25162 6.72587 4.58214 6.936 3.847L6.937 3.846Z" fill="black" stroke="black" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                            <svg class="particle" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M6.937 3.846L7.75 1L8.563 3.846C8.77313 4.58114 9.1671 5.25062 9.70774 5.79126C10.2484 6.3319 10.9179 6.72587 11.653 6.936L14.5 7.75L11.654 8.563C10.9189 8.77313 10.2494 9.1671 9.70874 9.70774C9.1681 10.2484 8.77413 10.9179 8.564 11.653L7.75 14.5L6.937 11.654C6.72687 10.9189 6.3329 10.2494 5.79226 9.70874C5.25162 9.1681 4.58214 8.77413 3.847 8.564L1 7.75L3.846 6.937C4.58114 6.72687 5.25062 6.3329 5.79126 5.79226C6.3319 5.25162 6.72587 4.58214 6.936 3.847L6.937 3.846Z" fill="black" stroke="black" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                            <svg class="particle" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M6.937 3.846L7.75 1L8.563 3.846C8.77313 4.58114 9.1671 5.25062 9.70774 5.79126C10.2484 6.3319 10.9179 6.72587 11.653 6.936L14.5 7.75L11.654 8.563C10.9189 8.77313 10.2494 9.1671 9.70874 9.70774C9.1681 10.2484 8.77413 10.9179 8.564 11.653L7.75 14.5L6.937 11.654C6.72687 10.9189 6.3329 10.2494 5.79226 9.70874C5.25162 9.1681 4.58214 8.77413 3.847 8.564L1 7.75L3.846 6.937C4.58114 6.72687 5.25062 6.3329 5.79126 5.79226C6.3319 5.25162 6.72587 4.58214 6.936 3.847L6.937 3.846Z" fill="black" stroke="black" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                            <svg class="particle" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M6.937 3.846L7.75 1L8.563 3.846C8.77313 4.58114 9.1671 5.25062 9.70774 5.79126C10.2484 6.3319 10.9179 6.72587 11.653 6.936L14.5 7.75L11.654 8.563C10.9189 8.77313 10.2494 9.1671 9.70874 9.70774C9.1681 10.2484 8.77413 10.9179 8.564 11.653L7.75 14.5L6.937 11.654C6.72687 10.9189 6.3329 10.2494 5.79226 9.70874C5.25162 9.1681 4.58214 8.77413 3.847 8.564L1 7.75L3.846 6.937C4.58114 6.72687 5.25062 6.3329 5.79126 5.79226C6.3319 5.25162 6.72587 4.58214 6.936 3.847L6.937 3.846Z" fill="black" stroke="black" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                            <svg class="particle" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M6.937 3.846L7.75 1L8.563 3.846C8.77313 4.58114 9.1671 5.25062 9.70774 5.79126C10.2484 6.3319 10.9179 6.72587 11.653 6.936L14.5 7.75L11.654 8.563C10.9189 8.77313 10.2494 9.1671 9.70874 9.70774C9.1681 10.2484 8.77413 10.9179 8.564 11.653L7.75 14.5L6.937 11.654C6.72687 10.9189 6.3329 10.2494 5.79226 9.70874C5.25162 9.1681 4.58214 8.77413 3.847 8.564L1 7.75L3.846 6.937C4.58114 6.72687 5.25062 6.3329 5.79126 5.79226C6.3319 5.25162 6.72587 4.58214 6.936 3.847L6.937 3.846Z" fill="black" stroke="black" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                            <svg class="particle" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M6.937 3.846L7.75 1L8.563 3.846C8.77313 4.58114 9.1671 5.25062 9.70774 5.79126C10.2484 6.3319 10.9179 6.72587 11.653 6.936L14.5 7.75L11.654 8.563C10.9189 8.77313 10.2494 9.1671 9.70874 9.70774C9.1681 10.2484 8.77413 10.9179 8.564 11.653L7.75 14.5L6.937 11.654C6.72687 10.9189 6.3329 10.2494 5.79226 9.70874C5.25162 9.1681 4.58214 8.77413 3.847 8.564L1 7.75L3.846 6.937C4.58114 6.72687 5.25062 6.3329 5.79126 5.79226C6.3319 5.25162 6.72587 4.58214 6.936 3.847L6.937 3.846Z" fill="black" stroke="black" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                            <svg class="particle" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M6.937 3.846L7.75 1L8.563 3.846C8.77313 4.58114 9.1671 5.25062 9.70774 5.79126C10.2484 6.3319 10.9179 6.72587 11.653 6.936L14.5 7.75L11.654 8.563C10.9189 8.77313 10.2494 9.1671 9.70874 9.70774C9.1681 10.2484 8.77413 10.9179 8.564 11.653L7.75 14.5L6.937 11.654C6.72687 10.9189 6.3329 10.2494 5.79226 9.70874C5.25162 9.1681 4.58214 8.77413 3.847 8.564L1 7.75L3.846 6.937C4.58114 6.72687 5.25062 6.3329 5.79126 5.79226C6.3319 5.25162 6.72587 4.58214 6.936 3.847L6.937 3.846Z" fill="black" stroke="black" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                            <svg class="particle" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M6.937 3.846L7.75 1L8.563 3.846C8.77313 4.58114 9.1671 5.25062 9.70774 5.79126C10.2484 6.3319 10.9179 6.72587 11.653 6.936L14.5 7.75L11.654 8.563C10.9189 8.77313 10.2494 9.1671 9.70874 9.70774C9.1681 10.2484 8.77413 10.9179 8.564 11.653L7.75 14.5L6.937 11.654C6.72687 10.9189 6.3329 10.2494 5.79226 9.70874C5.25162 9.1681 4.58214 8.77413 3.847 8.564L1 7.75L3.846 6.937C4.58114 6.72687 5.25062 6.3329 5.79126 5.79226C6.3319 5.25162 6.72587 4.58214 6.936 3.847L6.937 3.846Z" fill="black" stroke="black" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg><svg class="particle" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M6.937 3.846L7.75 1L8.563 3.846C8.77313 4.58114 9.1671 5.25062 9.70774 5.79126C10.2484 6.3319 10.9179 6.72587 11.653 6.936L14.5 7.75L11.654 8.563C10.9189 8.77313 10.2494 9.1671 9.70874 9.70774C9.1681 10.2484 8.77413 10.9179 8.564 11.653L7.75 14.5L6.937 11.654C6.72687 10.9189 6.3329 10.2494 5.79226 9.70874C5.25162 9.1681 4.58214 8.77413 3.847 8.564L1 7.75L3.846 6.937C4.58114 6.72687 5.25062 6.3329 5.79126 5.79226C6.3319 5.25162 6.72587 4.58214 6.936 3.847L6.937 3.846Z" fill="black" stroke="black" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg><svg class="particle" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M6.937 3.846L7.75 1L8.563 3.846C8.77313 4.58114 9.1671 5.25062 9.70774 5.79126C10.2484 6.3319 10.9179 6.72587 11.653 6.936L14.5 7.75L11.654 8.563C10.9189 8.77313 10.2494 9.1671 9.70874 9.70774C9.1681 10.2484 8.77413 10.9179 8.564 11.653L7.75 14.5L6.937 11.654C6.72687 10.9189 6.3329 10.2494 5.79226 9.70874C5.25162 9.1681 4.58214 8.77413 3.847 8.564L1 7.75L3.846 6.937C4.58114 6.72687 5.25062 6.3329 5.79126 5.79226C6.3319 5.25162 6.72587 4.58214 6.936 3.847L6.937 3.846Z" fill="black" stroke="black" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                            <svg class="particle" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M6.937 3.846L7.75 1L8.563 3.846C8.77313 4.58114 9.1671 5.25062 9.70774 5.79126C10.2484 6.3319 10.9179 6.72587 11.653 6.936L14.5 7.75L11.654 8.563C10.9189 8.77313 10.2494 9.1671 9.70874 9.70774C9.1681 10.2484 8.77413 10.9179 8.564 11.653L7.75 14.5L6.937 11.654C6.72687 10.9189 6.3329 10.2494 5.79226 9.70874C5.25162 9.1681 4.58214 8.77413 3.847 8.564L1 7.75L3.846 6.937C4.58114 6.72687 5.25062 6.3329 5.79126 5.79226C6.3319 5.25162 6.72587 4.58214 6.936 3.847L6.937 3.846Z" fill="black" stroke="black" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg><svg class="particle" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M6.937 3.846L7.75 1L8.563 3.846C8.77313 4.58114 9.1671 5.25062 9.70774 5.79126C10.2484 6.3319 10.9179 6.72587 11.653 6.936L14.5 7.75L11.654 8.563C10.9189 8.77313 10.2494 9.1671 9.70874 9.70774C9.1681 10.2484 8.77413 10.9179 8.564 11.653L7.75 14.5L6.937 11.654C6.72687 10.9189 6.3329 10.2494 5.79226 9.70874C5.25162 9.1681 4.58214 8.77413 3.847 8.564L1 7.75L3.846 6.937C4.58114 6.72687 5.25062 6.3329 5.79126 5.79226C6.3319 5.25162 6.72587 4.58214 6.936 3.847L6.937 3.846Z" fill="black" stroke="black" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg><svg class="particle" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M6.937 3.846L7.75 1L8.563 3.846C8.77313 4.58114 9.1671 5.25062 9.70774 5.79126C10.2484 6.3319 10.9179 6.72587 11.653 6.936L14.5 7.75L11.654 8.563C10.9189 8.77313 10.2494 9.1671 9.70874 9.70774C9.1681 10.2484 8.77413 10.9179 8.564 11.653L7.75 14.5L6.937 11.654C6.72687 10.9189 6.3329 10.2494 5.79226 9.70874C5.25162 9.1681 4.58214 8.77413 3.847 8.564L1 7.75L3.846 6.937C4.58114 6.72687 5.25062 6.3329 5.79126 5.79226C6.3319 5.25162 6.72587 4.58214 6.936 3.847L6.937 3.846Z" fill="black" stroke="black" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg><svg class="particle" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M6.937 3.846L7.75 1L8.563 3.846C8.77313 4.58114 9.1671 5.25062 9.70774 5.79126C10.2484 6.3319 10.9179 6.72587 11.653 6.936L14.5 7.75L11.654 8.563C10.9189 8.77313 10.2494 9.1671 9.70874 9.70774C9.1681 10.2484 8.77413 10.9179 8.564 11.653L7.75 14.5L6.937 11.654C6.72687 10.9189 6.3329 10.2494 5.79226 9.70874C5.25162 9.1681 4.58214 8.77413 3.847 8.564L1 7.75L3.846 6.937C4.58114 6.72687 5.25062 6.3329 5.79126 5.79226C6.3319 5.25162 6.72587 4.58214 6.936 3.847L6.937 3.846Z" fill="black" stroke="black" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg><svg class="particle" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M6.937 3.846L7.75 1L8.563 3.846C8.77313 4.58114 9.1671 5.25062 9.70774 5.79126C10.2484 6.3319 10.9179 6.72587 11.653 6.936L14.5 7.75L11.654 8.563C10.9189 8.77313 10.2494 9.1671 9.70874 9.70774C9.1681 10.2484 8.77413 10.9179 8.564 11.653L7.75 14.5L6.937 11.654C6.72687 10.9189 6.3329 10.2494 5.79226 9.70874C5.25162 9.1681 4.58214 8.77413 3.847 8.564L1 7.75L3.846 6.937C4.58114 6.72687 5.25062 6.3329 5.79126 5.79226C6.3319 5.25162 6.72587 4.58214 6.936 3.847L6.937 3.846Z" fill="black" stroke="black" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg><svg class="particle" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M6.937 3.846L7.75 1L8.563 3.846C8.77313 4.58114 9.1671 5.25062 9.70774 5.79126C10.2484 6.3319 10.9179 6.72587 11.653 6.936L14.5 7.75L11.654 8.563C10.9189 8.77313 10.2494 9.1671 9.70874 9.70774C9.1681 10.2484 8.77413 10.9179 8.564 11.653L7.75 14.5L6.937 11.654C6.72687 10.9189 6.3329 10.2494 5.79226 9.70874C5.25162 9.1681 4.58214 8.77413 3.847 8.564L1 7.75L3.846 6.937C4.58114 6.72687 5.25062 6.3329 5.79126 5.79226C6.3319 5.25162 6.72587 4.58214 6.936 3.847L6.937 3.846Z" fill="black" stroke="black" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg><svg class="particle" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M6.937 3.846L7.75 1L8.563 3.846C8.77313 4.58114 9.1671 5.25062 9.70774 5.79126C10.2484 6.3319 10.9179 6.72587 11.653 6.936L14.5 7.75L11.654 8.563C10.9189 8.77313 10.2494 9.1671 9.70874 9.70774C9.1681 10.2484 8.77413 10.9179 8.564 11.653L7.75 14.5L6.937 11.654C6.72687 10.9189 6.3329 10.2494 5.79226 9.70874C5.25162 9.1681 4.58214 8.77413 3.847 8.564L1 7.75L3.846 6.937C4.58114 6.72687 5.25062 6.3329 5.79126 5.79226C6.3319 5.25162 6.72587 4.58214 6.936 3.847L6.937 3.846Z" fill="black" stroke="black" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg><svg class="particle" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M6.937 3.846L7.75 1L8.563 3.846C8.77313 4.58114 9.1671 5.25062 9.70774 5.79126C10.2484 6.3319 10.9179 6.72587 11.653 6.936L14.5 7.75L11.654 8.563C10.9189 8.77313 10.2494 9.1671 9.70874 9.70774C9.1681 10.2484 8.77413 10.9179 8.564 11.653L7.75 14.5L6.937 11.654C6.72687 10.9189 6.3329 10.2494 5.79226 9.70874C5.25162 9.1681 4.58214 8.77413 3.847 8.564L1 7.75L3.846 6.937C4.58114 6.72687 5.25062 6.3329 5.79126 5.79226C6.3319 5.25162 6.72587 4.58214 6.936 3.847L6.937 3.846Z" fill="black" stroke="black" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="second_part">
                <div class="header">
                    <div class="bot_logo">
                        <img :src="'/icon/document_chatbot.webp'">
                    </div>
                    <p>File analyzer ChatBot</p>
                </div>
                <div class="body">
                    <div class="conversation_frame" @click="input_convers_close()">
                        <div v-for="(message, index) in conversation_data" :key="index" :class="message.role">
                            <div v-if="message.side === 'user'" class="message_frame user_character">
                                <div class="user_logo">
                                    <img :src="'/'+$page.props.auth.user.avatar ">
                                </div>
                                <div class="message">{{ message.text_content }}</div>
                            </div>
                            <div v-else class="message_frame ai_character" ref="messagesContainer">
                                <div class="user_logo">
                                    <img :src="'/icon/document_chatbot.webp'">
                                </div>
                                <div class="message">
                                    {{ message.text_content }}
                                    <button @click="copyMessage(message.text_content)"><i class="fa-regular fa-copy"></i></button>
                                </div>
                            </div>
                        </div>
                        <div v-for="(message, index) in messages_show" :key="index" :class="message.role">
                            <div v-if="message.role === 'user'" class="message_frame user_character">
                                <div class="user_logo">
                                    <img :src="'/'+$page.props.auth.user.avatar ">
                                </div>
                                <div class="message">{{ message.content }}</div>
                            </div>
                            <div v-else class="message_frame ai_character" ref="messagesContainer">
                                <div class="user_logo">
                                    <img :src="'/icon/ChatBot.webp'">
                                </div>
                                <div class="message">
                                    {{ message.content }}
                                    <button @click="copyMessage(message.content)"><i class="fa-regular fa-copy"></i></button>
                                </div>
                            </div>
                        </div>
                        <div v-if="isAssistantTyping" class="message_frame ai_character" ref="messagesContainer">
                            <div class="user_logo">
                                <img :src="'/icon/document_chatbot.webp'">
                            </div>
                            <div class="message">
                                <div class="loadingspinner">
                                    <div id="square1"></div>
                                    <div id="square2"></div>
                                    <div id="square3"></div>
                                    <div id="square4"></div>
                                    <div id="square5"></div>
                                </div>
                            </div>
                        </div>
                        <div class="no_chat_yet" v-if="!conversation_data[0]">
                            <div class="loader">
                                <div>
                                    <ul>
                                    <li>
                                        <svg fill="currentColor" viewBox="0 0 90 120">
                                        <path d="M90,0 L90,120 L11,120 C4.92486775,120 0,115.075132 0,109 L0,11 C0,4.92486775 4.92486775,0 11,0 L90,0 Z M71.5,81 L18.5,81 C17.1192881,81 16,82.1192881 16,83.5 C16,84.8254834 17.0315359,85.9100387 18.3356243,85.9946823 L18.5,86 L71.5,86 C72.8807119,86 74,84.8807119 74,83.5 C74,82.1745166 72.9684641,81.0899613 71.6643757,81.0053177 L71.5,81 Z M71.5,57 L18.5,57 C17.1192881,57 16,58.1192881 16,59.5 C16,60.8254834 17.0315359,61.9100387 18.3356243,61.9946823 L18.5,62 L71.5,62 C72.8807119,62 74,60.8807119 74,59.5 C74,58.1192881 72.8807119,57 71.5,57 Z M71.5,33 L18.5,33 C17.1192881,33 16,34.1192881 16,35.5 C16,36.8254834 17.0315359,37.9100387 18.3356243,37.9946823 L18.5,38 L71.5,38 C72.8807119,38 74,36.8807119 74,35.5 C74,34.1192881 72.8807119,33 71.5,33 Z"></path>
                                        </svg>
                                    </li>
                                    <li>
                                        <svg fill="currentColor" viewBox="0 0 90 120">
                                        <path d="M90,0 L90,120 L11,120 C4.92486775,120 0,115.075132 0,109 L0,11 C0,4.92486775 4.92486775,0 11,0 L90,0 Z M71.5,81 L18.5,81 C17.1192881,81 16,82.1192881 16,83.5 C16,84.8254834 17.0315359,85.9100387 18.3356243,85.9946823 L18.5,86 L71.5,86 C72.8807119,86 74,84.8807119 74,83.5 C74,82.1745166 72.9684641,81.0899613 71.6643757,81.0053177 L71.5,81 Z M71.5,57 L18.5,57 C17.1192881,57 16,58.1192881 16,59.5 C16,60.8254834 17.0315359,61.9100387 18.3356243,61.9946823 L18.5,62 L71.5,62 C72.8807119,62 74,60.8807119 74,59.5 C74,58.1192881 72.8807119,57 71.5,57 Z M71.5,33 L18.5,33 C17.1192881,33 16,34.1192881 16,35.5 C16,36.8254834 17.0315359,37.9100387 18.3356243,37.9946823 L18.5,38 L71.5,38 C72.8807119,38 74,36.8807119 74,35.5 C74,34.1192881 72.8807119,33 71.5,33 Z"></path>
                                        </svg>
                                    </li>
                                    <li>
                                        <svg fill="currentColor" viewBox="0 0 90 120">
                                        <path d="M90,0 L90,120 L11,120 C4.92486775,120 0,115.075132 0,109 L0,11 C0,4.92486775 4.92486775,0 11,0 L90,0 Z M71.5,81 L18.5,81 C17.1192881,81 16,82.1192881 16,83.5 C16,84.8254834 17.0315359,85.9100387 18.3356243,85.9946823 L18.5,86 L71.5,86 C72.8807119,86 74,84.8807119 74,83.5 C74,82.1745166 72.9684641,81.0899613 71.6643757,81.0053177 L71.5,81 Z M71.5,57 L18.5,57 C17.1192881,57 16,58.1192881 16,59.5 C16,60.8254834 17.0315359,61.9100387 18.3356243,61.9946823 L18.5,62 L71.5,62 C72.8807119,62 74,60.8807119 74,59.5 C74,58.1192881 72.8807119,57 71.5,57 Z M71.5,33 L18.5,33 C17.1192881,33 16,34.1192881 16,35.5 C16,36.8254834 17.0315359,37.9100387 18.3356243,37.9946823 L18.5,38 L71.5,38 C72.8807119,38 74,36.8807119 74,35.5 C74,34.1192881 72.8807119,33 71.5,33 Z"></path>
                                        </svg>
                                    </li>
                                    <li>
                                        <svg fill="currentColor" viewBox="0 0 90 120">
                                        <path d="M90,0 L90,120 L11,120 C4.92486775,120 0,115.075132 0,109 L0,11 C0,4.92486775 4.92486775,0 11,0 L90,0 Z M71.5,81 L18.5,81 C17.1192881,81 16,82.1192881 16,83.5 C16,84.8254834 17.0315359,85.9100387 18.3356243,85.9946823 L18.5,86 L71.5,86 C72.8807119,86 74,84.8807119 74,83.5 C74,82.1745166 72.9684641,81.0899613 71.6643757,81.0053177 L71.5,81 Z M71.5,57 L18.5,57 C17.1192881,57 16,58.1192881 16,59.5 C16,60.8254834 17.0315359,61.9100387 18.3356243,61.9946823 L18.5,62 L71.5,62 C72.8807119,62 74,60.8807119 74,59.5 C74,58.1192881 72.8807119,57 71.5,57 Z M71.5,33 L18.5,33 C17.1192881,33 16,34.1192881 16,35.5 C16,36.8254834 17.0315359,37.9100387 18.3356243,37.9946823 L18.5,38 L71.5,38 C72.8807119,38 74,36.8807119 74,35.5 C74,34.1192881 72.8807119,33 71.5,33 Z"></path>
                                        </svg>
                                    </li>
                                    <li>
                                        <svg fill="currentColor" viewBox="0 0 90 120">
                                        <path d="M90,0 L90,120 L11,120 C4.92486775,120 0,115.075132 0,109 L0,11 C0,4.92486775 4.92486775,0 11,0 L90,0 Z M71.5,81 L18.5,81 C17.1192881,81 16,82.1192881 16,83.5 C16,84.8254834 17.0315359,85.9100387 18.3356243,85.9946823 L18.5,86 L71.5,86 C72.8807119,86 74,84.8807119 74,83.5 C74,82.1745166 72.9684641,81.0899613 71.6643757,81.0053177 L71.5,81 Z M71.5,57 L18.5,57 C17.1192881,57 16,58.1192881 16,59.5 C16,60.8254834 17.0315359,61.9100387 18.3356243,61.9946823 L18.5,62 L71.5,62 C72.8807119,62 74,60.8807119 74,59.5 C74,58.1192881 72.8807119,57 71.5,57 Z M71.5,33 L18.5,33 C17.1192881,33 16,34.1192881 16,35.5 C16,36.8254834 17.0315359,37.9100387 18.3356243,37.9946823 L18.5,38 L71.5,38 C72.8807119,38 74,36.8807119 74,35.5 C74,34.1192881 72.8807119,33 71.5,33 Z"></path>
                                        </svg>
                                    </li>
                                    <li>
                                        <svg fill="currentColor" viewBox="0 0 90 120">
                                        <path d="M90,0 L90,120 L11,120 C4.92486775,120 0,115.075132 0,109 L0,11 C0,4.92486775 4.92486775,0 11,0 L90,0 Z M71.5,81 L18.5,81 C17.1192881,81 16,82.1192881 16,83.5 C16,84.8254834 17.0315359,85.9100387 18.3356243,85.9946823 L18.5,86 L71.5,86 C72.8807119,86 74,84.8807119 74,83.5 C74,82.1745166 72.9684641,81.0899613 71.6643757,81.0053177 L71.5,81 Z M71.5,57 L18.5,57 C17.1192881,57 16,58.1192881 16,59.5 C16,60.8254834 17.0315359,61.9100387 18.3356243,61.9946823 L18.5,62 L71.5,62 C72.8807119,62 74,60.8807119 74,59.5 C74,58.1192881 72.8807119,57 71.5,57 Z M71.5,33 L18.5,33 C17.1192881,33 16,34.1192881 16,35.5 C16,36.8254834 17.0315359,37.9100387 18.3356243,37.9946823 L18.5,38 L71.5,38 C72.8807119,38 74,36.8807119 74,35.5 C74,34.1192881 72.8807119,33 71.5,33 Z"></path>
                                        </svg>
                                    </li>
                                    </ul>
                            </div><span>Loading</span></div>
                        </div>
                    </div>
                    <div class="inputs">
                        <textarea v-model="userQuestion" id="userQuestion" @keyup.enter="sendMessage" placeholder="Tape your message here" @click="input_convers_open()" :style="{height: input_convers? '250px':'70px'}">
                        </textarea>
                        <button @click="sendMessage" class="button" :href="`/tools_Conversation/${pages.id}/generate`">
                            <div class="svg-wrapper-1">
                                <div class="svg-wrapper">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24"
                                    width="24"
                                    height="24"
                                >
                                    <path fill="none" d="M0 0h24v24H0z"></path>
                                    <path
                                    fill="currentColor"
                                    d="M1.946 9.315c-.522-.174-.527-.455.01-.634l19.087-6.362c.529-.176.832.12.684.638l-5.454 19.086c-.15.529-.455.547-.679.045L12 14l6-8-8 6-8.054-2.685z"
                                    ></path>
                                </svg>
                                </div>
                            </div>
                            <span>Send</span>
                        </button>
                    </div>
                </div>
            </div>
            <!-- popup -->
            <div class="add_tikets_frame" v-if="Conv_frame" >
                                <div class="fram_tikets">
                                    <div class="header">
                                        <div class="logo"></div>
                                        <div class="exite" id="exit_popup" @click="openConv()"><i class="fa-sharp fa-solid fa-circle-xmark"></i></div>
                                    </div>
                                    <div class="body_fram">
                                        <form @submit.prevent="save_Categorie" class="form1">
                                            <div class="inputs">
                                                <input 
                                                    type="text" 
                                                    id="name" 
                                                    placeholder="Name Of Categorie"
                                                    v-model="Conv_form.title"
                                                    :error="Conv_form.errors.title"
                                                    required
                                                >
                                            </div>
                                            <div class="inputs">
                                                <label for="">Upload a Word/PDF/CSV File (Max: 2Mb)</label>
                                                <FileInput
                                                    required
                                                    v-model="Conv_form.file_path"
                                                    :error="Conv_form.errors.file_path"
                                                    class="file_shoser"
                                                    type="file"
                                                    accept="application/pdf"
                                                    @change="handleFileChange"
                                                />
                                                <p class="text-red-700 fileSizeError" v-if="!fileSizeError">the max size is 2Mb</p>
                                            </div>
                                            <div class="save">
                                                <button type="submit" class="tiket_save" :class="{ 'opacity-25': Conv_form.processing }" :disabled="Conv_form.processing">
                                                    save
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
            </div>

            <div class="add_tikets_frame" v-if="Conv_frameedit" >
                                <div class="fram_tikets">
                                    <div class="header">
                                        <div class="logo"></div>
                                        <div class="exite" id="exit_popup" @click="openConvedit()"><i class="fa-sharp fa-solid fa-circle-xmark"></i></div>
                                    </div>
                                    <div class="body_fram">
                                        <form @submit.prevent="save_Categorieedit" class="form1">
                                            <div class="inputs">
                                                <input 
                                                    type="text" 
                                                    id="name" 
                                                    placeholder="Name Of Categorie"
                                                    v-model="Conv_formedit.title"
                                                    :error="Conv_formedit.errors.title"
                                                    required
                                                >
                                            </div>
                                            <div class="save">
                                                <button type="submit" class="tiket_save" :class="{ 'opacity-25': Conv_formedit.processing }" :disabled="Conv_formedit.processing">
                                                    save
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
            </div>

            <div class="popup_favorit_add" v-if="popup_tokens">
                <div class="notificationCard">
                    <i class="fa-solid fa-xmark"></i>
                    <p class="notificationHeading">you reached your max limit of words in your plan , please by other plan</p>
                    <div class="buttonContainer">
                        <Link class="AllowBtn flex justify-center items-center" :href="route('Subscription')">OK</Link>
                    </div>
                </div>
            </div>
            <div class="popup_favorit_add" v-if="popup_error_generate">
                <div class="notificationCard">
                    <i class="fa-solid fa-xmark"></i>
                    <p class="notificationHeading">An error occurred, make sure your connection is stable and try again</p>
                    <div class="buttonContainer">
                        <button class="AllowBtn flex justify-center items-center" @click="popup_error_generate_fun()">ok</button>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import FileInput from "@/Components/FileInput.vue";
import { Head , Link} from '@inertiajs/vue3';
</script>

<script>
export default {
    name: 'App',
    components: {
        Head,
        Link,
    },
    props: {
        pages: Object,
        conversations_list: Object,
        conversation_data: Object,
        current_conversation: Object,
        token_max: Object,
        token_usage: Object,
        pdfcontent: Object,

        chatData: {
            type: Object,
            required: true
        }
    },

    data() {
        return {
            open_convertation: false,
            fileSizeError: true,
            countToken : null,
            curentToken : 0,
            popup_tokens : false,
            popup_error_generate :  false,

            searchQuery: '',
            input_convers: false,

            //chat
            userName: 'User', 
            userQuestion: null,
            messages_show: [],
            messages: [],
            messages_user: null,
            isAssistantTyping: false,

            //edit cat
            Conv_frame : false,
            Conv_form: this.$inertia.form({
                title: null,
                file_path: null,
            }),

            Conv_frameedit : false,
            Conv_formedit: this.$inertia.form({
                title: null,
                id_conv: null,
            }),
        }
    },

    methods: {
        open_close(){
            this.open_convertation?
                this.open_convertation = false:
                this.open_convertation = true;
        },
        popup_tokens_over(){
            this.popup_tokens?
                this.popup_tokens = false:
                this.popup_tokens = true;
        },
        popup_error_generate_fun(){
            this.popup_error_generate?
                this.popup_error_generate = false:
                this.popup_error_generate = true;
        },
        checkToken(){
            if(this.token_usage){
                this.countToken = this.token_usage.usage_words;

                if(this.$page.props.auth.user.special_user)
                    this.countToken = this.token_usage.usage_words;

                else if(this.$page.props.auth.user.payment)
                    this.curentToken = this.token_max.max_word;

                else
                    this.curentToken = 1000;
            }
        },

        input_convers_close(){
            this.input_convers = false;
        },
        input_convers_open(){
            this.input_convers = true;
        },

        //chat
        sendMessage() {
            const question = 'analyse this text from pdf document '+this.pdfcontent.original.text+' and just answer me on this question ,'+this.userQuestion+'?';
            this.messages.push({ role: 'user', name: this.userName, content: question});
			this.messages_show.push({ role: 'user', name: this.userName, content: this.userQuestion});
            this.messages_user = this.userQuestion,
            this.userQuestion = '';
            this.input_convers_close();
            if(this.$page.props.auth.user.special_user)
                this.getAnswer();
            else if(this.countToken <= this.curentToken)
                this.getAnswer();
            else
                this.popup_tokens_over();
        },
        getAnswer() {
            this.isAssistantTyping = true;
            axios.post(`/tools_Conversation/${this.pages.id}/${this.current_conversation.id}/generate`, {
                messages: this.messages,
                messages_user: this.messages_user,
            })
            .then(response => {
                this.countToken_fun(this.pages.id,response.data.usage.total_tokens)
                this.isAssistantTyping = false;
                const answer = response.data.choices[0].message.content;
                const assistantMessage = {
                    role: 'assistant',
                    name: 'Assistant',
                    content: ''
                };
                this.messages_user = '';
                this.messages_show.push(assistantMessage);
                this.displayTypingAnimation(answer);
                setTimeout(() => {
                    assistantMessage.content = answer;
                    this.messages.push(assistantMessage);
                }, answer.length * 50);
            })
            .catch(error => {
                console.error(error);
                this.popup_error_generate_fun();
                this.isAssistantTyping = false;
            });
        },
        countToken_fun(id_tool,tokens) {
            axios.post(`/ai_tools_template/${id_tool}/${tokens}/countToken`)
                .then(response => {
                    if (response.data.success) {
                        this.countToken = response.data.token_usage;
                    }
                })
                .catch(error => {
                console.error('Error liking comment:', error);
            });
        },
        //typing style 
        displayTypingAnimation(message) {
            let index = 0;
            const typingSpeed = 5;
            let fullMessage = message;
            message = '';

            const typingInterval = setInterval(() => {
                if (index < fullMessage.length) {
                    message += fullMessage.charAt(index);
                    if (this.messages_show.length > 0) {
                        this.messages_show[this.messages_show.length - 1].content = message;
                    } else {
                        this.messages_show.push({
                            role: 'assistant',
                            name: 'Assistant',
                            content: message
                        });
                    }
                    index++;
                } else {
                    clearInterval(typingInterval);
                }
            }, typingSpeed);
        },

        //add conv
        openConv() {
            this.Conv_frame?
                this.Conv_frame=false:
                this.Conv_frame=true;
        },

        openConvedit(id_conv,title) {
            this.Conv_frameedit?
                this.Conv_frameedit=false:
                [
                    this.Conv_formedit.id_conv = id_conv,
                    this.Conv_formedit.title = title,
                    this.Conv_frameedit=true,
                ];
        },

        save_Categorie() {
            this.Conv_form.post(`/tools_Conversation/${this.pages.id}/store`, {
                onSuccess: () => {
                this.Conv_frame = false;
                this.Conv_form.reset();
                },
            });
        },

        save_Categorieedit() {
            this.Conv_formedit.post(`/tools_Conversation/${this.Conv_formedit.id_conv}/edit`, {
                onSuccess: () => {
                this.Conv_frameedit = false;
                this.Conv_formedit.reset();
                },
            });
        },
        //copy text
        async copyMessage(text) {
            try {
                await navigator.clipboard.writeText(text);
                alert('Message copied to clipboard!');
            } catch (err) {
                console.error('Failed to copy: ', err);
            }
        },

        handleFileChange(event) {
            const file = event.target.files[0];
            const maxSize = 2 * 1024 * 1024; 

            if (file && file.size > maxSize) {
                this.fileSizeError = false;
            } else {
                this.fileSizeError = true;
            }
        },

    },
    mounted(){
        this.checkToken()
    },
    computed: {
        filtereditms() {
            const query = this.searchQuery.toLowerCase();
            return this.conversations_list.filter(conversation => conversation.title.toLowerCase().includes(query));
        }
    }
}
</script>