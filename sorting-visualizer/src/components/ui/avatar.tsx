import { Avatar as ChakraAvatar, AvatarGroup as ChakraAvatarGroup } from "@chakra-ui/react";
import * as React from "react";

type ImageProps = React.ImgHTMLAttributes<HTMLImageElement>;

// ✅ Use React.ComponentProps<typeof ChakraAvatar> instead of ChakraAvatar.RootProps
export interface AvatarProps extends React.ComponentProps<typeof ChakraAvatar> {
  name?: string;
  src?: string;
  srcSet?: string;
  loading?: ImageProps["loading"];
  icon?: React.ReactElement;
  fallback?: React.ReactNode;
}

export const Avatar = React.forwardRef<HTMLDivElement, AvatarProps>(function Avatar(props, ref) {
  const { name, src, srcSet, loading, icon, fallback, children, ...rest } = props;
  return (
    <ChakraAvatar ref={ref} {...rest}>
      <ChakraAvatar.Fallback name={name}>{icon || fallback}</ChakraAvatar.Fallback>
      <ChakraAvatar.Image src={src} srcSet={srcSet} loading={loading} />
      {children}
    </ChakraAvatar>
  );
});

export const AvatarGroup = ChakraAvatarGroup;
