import { Button, ButtonProps } from '@radix-ui/themes';
const ButtonSmall = (props: ButtonProps) => <Button size="1" {...props} />;

ButtonSmall.displayName = 'ButtonSmall';
export default ButtonSmall;
