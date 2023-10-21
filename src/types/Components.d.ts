// ApplicationLogo
declare module '@/Components/ApplicationLogo' {
	import React from 'react';
	export interface ApplicationLogoProps {
		className: string;
	}
	// コンポーネントの型
	const ApplicationLogo: React.FC<ApplicationLogoProps>;
	export default ApplicationLogo;
}


// Checkbox
declare module '@/Components/Checkbox' {
	import React from 'react';
	// コンポーネントの型
	const Checkbox: React.FC<CheckboxProps>;
	export default Checkbox;
}


// InputError
declare module '@/Components/InputError' {
	import React from 'react';
	// コンポーネントの型
	const InputError: React.FC<InputErrorProps>;
	export default InputError;
}


// InputLabel
declare module '@/Components/InputLabel' {
	import React from 'react';
	// コンポーネントの型
	const InputLabel: React.FC<InputLabelProps>;
	export default InputLabel;
}


// LinkButton
declare module '@/Components/LinkButton' {
	import React from 'react';
	// コンポーネントの型
	const LinkButton: React.FC<LinkButtonProps>;
	export default LinkButton;
}


// PrimaryButton
declare module '@/Components/PrimaryButton' {
	import React from 'react';
	// コンポーネントの型
	const PrimaryButton: React.FC<PrimaryButtonProps>;
	export default PrimaryButton;
}


// TextInput
declare module '@/Components/TextInput' {
	import React from 'react';
	// コンポーネントの型
	const TextInput: React.FC<TextInputProps>;
	export default TextInput;
}