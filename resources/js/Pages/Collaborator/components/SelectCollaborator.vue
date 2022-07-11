<template>
    <div class="select-box">
        <div
            v-if="showOptions"
            class="options-container shadow"
        >
            <div
                v-for="(option, index) in options"
                :key="index"
                class="option py-2 px-2 hover:active cursor-pointer relative"
                @click.prevent="selectOption(option.value)"
                @mouseover="hoverOption = true"
                @mouseleave="hoverOption = false"
                :class="{'active': (option.value == modelValue) && !hoverOption, 'border-option': (index + 1) < options.length}"
            >
                <input
                    type="radio"
                    class="radio"
                    id="automoviles"
                    name="category"
                />
                <span
                    @mouseover="hoverOption = true"
                    @mouseleave="hoverOption = false"
                >{{ option.label }}</span>
            </div>
        </div>
        <div
            class="selected w-100 rounded py-2 pr-3 inline-block flex justify-content-between relative collaborator-box"
            @click.prevent="openOptions()"
            :class="{'disabled-input': disabled, 'error-input': error,  'cursor-pointer': !disabled, 'pl-8': icon, 'pl-2': !icon}"
        >
            <i v-if="icon" class="fas fa-search absolute inset-y-1/3 px-2"></i>
            <span class="inline-block">{{ labelSelect }}</span>
            <i class="fas fa-angle-down inline-block"></i>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            showOptions: false,
            hoverOption: false,
        }
    },
    emits: ['update:modelValue'],
    props: {
        error:{
            type: Boolean,
            default: false,
        },
        disabled:{
            type: Boolean,
            default: false,
        },
        textLabel: {
            type: String,
            default: '',
        },
        modelValue: {
            type: String,
            default: '',
        },
        options: {
            type: Array,
            default: () => ([]),
        },
        icon: {
            type: String,
            default: '',
        }
    },
    computed: {
        label () {
            var lb = this.options.find(item => this.modelValue === item.value)
            var text = lb ? lb.label : null
            return text
        },
        labelSelect (){
            return this.label || this.textLabel
        }
    },
    methods: {
        openOptions (){
            if (!this.disabled) {
                this.showOptions = !this.showOptions
                console.log(this.showOptions)
                this.hoverOption = false
            } else {
                 this.showOptions = false
                 this.hoverOption = false
            }
        },
        selectOption (value) {
           var op = this.options.find(item => item.value === value)
           this.$emit('update:modelValue', op.value)
            this.showOptions = false
        }
    },
}
</script>

<style scoped>
	.select-box{
		display: flex;
		flex-direction: column;
		position: relative;
	}
	.select-box .options-container{
		position: absolute;	
		background-color: #f5f5f5;
		top: 3rem;
		z-index: 90000;
		min-height: 0;
		width: 100%;
		transition: all 0.4;
		border-radius: 8px;
		overflow: hidden;
		order: 1;
	}

    .border-option{
        border-bottom: 1 solid#c2c2c2;
    }

	.select-box .options-container .active {
		/*max-height: 240px;
        overflow-y: scroll;*/
        background-color: #aad1e6;
	}

	.select-box .options-container::-webkit-scrollbar {
		width: 8px;
		background: #0d141f;
		border-radius: 0 8px 8px 0;
    }

	.select-box .options-container::-webkit-scrollbar-thumb {
		background: #525861;
		border-radius: 0 8px 8px 0;
	}

	.select-box .selected {
		position: relative;
		order: 0;
        border: solid 1.8px #bfbfbf;
        background-color: #e7f6ff;
        width:100%;
	}

    .select-box .option {
        background-color: #f5f5f5;
        width:100%;
	}
    
    .select-box .error-input{
        border: solid 2.5px red !important;
    }
    
    .select-box .disabled-input{
        border: solid 2.5px #ebebeb;
		background-color: #ebebeb;
    }

	.select-box .option:hover {
		background-color: #aad1e6;
	}

	.select-box label{
		cursor: pointer;
	}

	.select-box .option .radio{
		display: none;
	}
</style>