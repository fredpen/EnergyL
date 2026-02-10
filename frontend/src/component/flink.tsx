import React from "react";

interface LinkButtonProps {
    href: string;
    text: string;
    target?: "_blank" | "_self";
    className?: string;
}

const FLink: React.FC<LinkButtonProps> = (
    {
        href,
        text,
        target = "_self",
        className = "text-blue-500 hover:underline",
    }) => {
    return (
        <a href={href} target={target} rel={target === "_blank" ? "noopener noreferrer" : undefined}
           className={className}>
            {text}
        </a>
    );
};

export default FLink;
