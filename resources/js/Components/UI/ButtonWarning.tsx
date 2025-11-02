import { Button, ButtonProps } from '@radix-ui/themes';
const ButtonWarning = (props: ButtonProps) => (
    <Button color="yellow" {...props} />
);

ButtonWarning.displayName = 'ButtonWarning';
export default ButtonWarning;
